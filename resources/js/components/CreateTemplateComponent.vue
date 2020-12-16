<template>
    <div class="input-group-append">
        <modal-component
                v-bind:show_modal="showModal"
                v-bind:errors="errors"
                v-on:show-modal="updateShowModal">
            <template v-slot:modal-title>Create template</template>
            <template v-slot:modal-body>
                <div class="form-group">
                    <input
                            class="form-control"
                            name="name"
                            type="text"
                            title="Name"
                            placeholder="Name"
                            v-model="name"/>
                </div>
            </template>
            <template v-slot:modal-button>
                <div class="form-group mb-0">
                    <button
                            type="button"
                            class="btn-primary btn"
                            @click.prevent="store">Store</button>
                </div>
            </template>
            <template v-slot:button></template>
        </modal-component>

        <button class="btn btn-outline-secondary text-white bg-secondary" @click="updateShowModal(true)"><i class="fas fa-plus"></i></button>
    </div>
</template>

<script>
    export default
    {
        data()
        {
            return {
                name: '',
                showModal: false,
                errors: [],
            }
        },
        props:
            [
                'store_template_endpoint',
            ],
        methods:
            {
                store() {
                    axios
                        .post(this.store_template_endpoint, {
                            name: this.name
                        })
                        .then(response =>
                        {
                            this.$emit('switch-template', response.data);

                            this.name = '';

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
