<template>
    <div>
        <div class="modal-mask" v-if="this.show_modal">
            <div class="modal-wrapper" @click="clickWrapper">
                <div class="modal-container">

                    <div class="modal-header">
                        <h5 class="modal-title">
                            <slot name="modal-title"></slot>
                        </h5>
                        <button type="button" class="close" @click.prevent="showModal(false)">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <slot name="modal-body"></slot>
                    </div>

                    <div class="modal-footer">
                        <div class="w-100 d-flex justify-content-end">
                            <slot name="modal-button"></slot>
                        </div>

                        <ul class="errors list-unstyled w-100" v-if="this.errors.length">
                            <li v-for="error in this.errors" v-html="error" class="mb-2"></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default
    {
        data()
        {
            return {}
        },
        props:
            [
                'show_modal',
                'errors',
            ],
        methods:
            {
                clickWrapper(e) {
                    if ( (e.target.className === 'modal-wrapper')) {
                        this.showModal(false);
                    }

                    this.$emit('unselect-option');
                },
                showModal(value) {
                    this.$emit('show-modal', value);
                }
            }
    }
</script>
