<template>
    <div class="container-fluid">
        <div class="row my-4">
            <div class="col-lg-8 col-sm-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header">Items order</div>
                    <div class="card-body" v-if="templateItems">
                        <draggable
                            class="list-group"
                            :list="templateItems"
                            group="items"
                            @change="updateTemplateItems">
                            <div
                                class="p-3 mb-2 bg-light border pointer"
                                v-for="(item, key) in templateItems"
                                :key="item.id">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <div class="mb-1"><span class="badge badge-success">{{ key + 1 }}.</span>&nbsp;{{ item.name }}</div>
                                        <div class="text-sm text-secondary">XX signups</div>
                                    </div>
                                    <i class="fas fa-arrows-alt text-secondary"></i>
                                </div>
                            </div>
                        </draggable>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="row">
                    <div class="col-12 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-header">Template</div>
                            <div class="card-body bg-light">

                                <div class="input-group mb-3" v-if="template && templates">
                                    <select class="custom-select" @change="onTemplateChange">
                                        <option
                                            :selected="template.id === temp.id"
                                            v-for="(temp, key) in templates"
                                            :value="key"
                                            v-html="temp.name"></option>
                                    </select>

                                    <create-template-component
                                        v-on:switch-template="addTemplate($event)"
                                        v-bind:store_template_endpoint="store_template_endpoint"></create-template-component>
                                </div>

                                <div v-if="template">
                                    <edit-template-component
                                        v-on:switch-template="setTemplate($event)"
                                        v-bind:template="this.template"
                                        v-bind:store_template_endpoint="store_template_endpoint"></edit-template-component>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div v-if="templates && templates.length > 1">
                                    <delete-template-component
                                        v-on:switch-template="unsetTemplate($event)"
                                        v-bind:template="this.template"
                                        v-bind:delete_template_endpoint="delete_template_endpoint"></delete-template-component>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12" v-if="items">
                        <draggable
                            class="list-group"
                            :list="items"
                            group="items"
                            :sort="false">
                            <div
                                class="p-3 bg-white mb-2 border rounded pointer"
                                v-for="item in items"
                                :key="item.id">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span>{{ item.name}}</span>
                                    <i class="fas fa-arrows-alt text-secondary"></i>
                                </div>
                            </div>
                        </draggable>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import draggable from 'vuedraggable'

export default
{
    components: {
        draggable
    },
    created()
    {
        this.getTemplates();
    },
    mounted()
    {
        //
    },
    props: [
        'get_items_endpoint',
        'get_templates_endpoint',
        'get_template_items_endpoint',
        'store_template_endpoint',
        'delete_template_endpoint',
        'update_template_items_endpoint'
    ],
    data()
    {
        return {
            template: null,
            items: null,
            templates: null,
            templateItems: null
        }
    },
    methods:
        {
        onTemplateChange: function(event)
        {
            let k = parseInt(event.target.value);

            for (let key in this.templates) {
                if (this.templates.hasOwnProperty(key)) {
                    let template = this.templates[key];
                    key = parseInt(key);
                    if (key === k) {
                        this.template = template;
                    }
                }
            }

            this.getTemplateItems()
        },
        getItems: function()
        {
            axios
                .get(this.get_items_endpoint + '?template_id=' + this.template.id)
                .then(response =>
                {
                    this.items = response.data;
                });
        },
        getTemplates: function()
        {
            axios
                .get(this.get_templates_endpoint)
                .then(response =>
                {
                    this.templates = response.data.templates;

                    if (!this.template) {
                        this.template = response.data.template
                            ? response.data.template
                            : this.templates[0];

                        this.getTemplateItems();
                    }
                });
        },
        getTemplateItems: function()
        {
            axios
                .post(this.get_template_items_endpoint, {
                    template_id: this.template.id
                })
                .then(response =>
                {
                    this.templateItems = response.data;

                    this.getItems();
                });
        },
        updateTemplateItems: function(evt)
        {
            axios
                .post(this.update_template_items_endpoint, {
                    template_id: this.template.id,
                    items: this.templateItems
                })
                .then(response =>
                {
                    this.templateItems = response.data;
                });
        },
        unsetTemplate(templates)
        {
            this.templates = templates;
            this.template = this.templates[0];

            this.getTemplateItems();
        },
        setTemplate(template)
        {
            this.template = template;

            for (let key in this.templates) {
                if (this.templates.hasOwnProperty(key)) {
                    let template = this.templates[key];
                    key = parseInt(key);
                    if (template.id === this.template.id) {
                        this.templates[key] = this.template;
                    }
                }
            }
        },
        addTemplate(template)
        {
            this.templates.push(template);
            this.template = template;

            this.getTemplateItems();
        }
    }
}
</script>
