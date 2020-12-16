<template>
    <div>
        <modal-component
                v-bind:show_modal="showModal"
                v-bind:errors="errors"
                v-on:show-modal="updateShowModal">
            <template v-slot:modal-title>Edit template</template>
            <template v-slot:modal-body>
                <div class="form-group">
                    <input
                            class="form-control"
                            name="name"
                            type="text"
                            title="Name"
                            placeholder="Name"
                            v-model="template.name"/>
                </div>
            </template>
            <template v-slot:modal-button>
                <div class="form-group mb-0">
                    <button
                            type="button"
                            class="btn-primary btn"
                            @click.prevent="update">Update</button>
                </div>
            </template>
        </modal-component>

        <a class="text-secondary text-sm" href="#" @click="updateShowModal(true)">
            <i class="fas fa-edit"></i>
            Edit name of template</a>
    </div>

</template>

<script>
    export default
    {
        data()
        {
            return {
                showModal: false,
                errors: [],
            }
        },
        props:
            [
                'template',
                'store_template_endpoint',
            ],
        methods:
            {
                update() {
                    axios
                        .post(this.store_template_endpoint, {
                            name: this.template.name,
                            id: this.template.id
                        })
                        .then(response =>
                        {
                            this.$emit('switch-template', response.data);

                            this.showModal = false;
                        })
                        .catch(error => {

                            console.log('Error');
                            console.log(error.response.data);

                            if (error.response.data.errors) {
                                for (let [key, err] of Object.entries(error.response.data.errors)) {
                                    this.errors = this.errors.concat(err)
                                }
                            } else {
                                console.log(error.response);
                            }
                        });
                },
                updateShowModal(value) {
                    this.showModal = value;
                }
            }
    }
</script>
