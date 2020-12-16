<template>
    <div>
        <modal-component
                v-bind:show_modal="showModal"
                v-bind:errors="errors"
                v-on:show-modal="updateShowModal">
            <template v-slot:modal-title>Delete template</template>
            <template v-slot:modal-body>
                Delete template {{ template.name }}?
            </template>
            <template v-slot:modal-button>
                <div class="form-group mb-0">
                    <button
                            type="button"
                            class="btn-danger btn"
                            @click.prevent="destroy">Delete</button>
                </div>
            </template>
        </modal-component>

        <a class="text-danger text-sm" href="#" @click.prevent="updateShowModal(true)">
            <i class="fas fa-trash"></i>
            Delete this template</a>
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
                'delete_template_endpoint',
            ],
        methods:
            {
                destroy() {
                    axios
                        .post(this.delete_template_endpoint, {
                            template_id: this.template.id
                        })
                        .then(response =>
                        {
                            this.$emit('switch-template', response.data);

                            this.showModal = false;
                        })
                        .catch(error => {

                            console.log('Error');

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
