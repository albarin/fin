<template>
    <div class="alert notification" v-bind:class="['is-' + type]" v-show="show">
        <strong>Success!</strong> {{ body }}
    </div>
</template>

<script>
    export default {
        props: [
            'message',
            'kind'
        ],

        data() {
            return {
                type: 'success',
                body: '',
                show: false,
            }
        },

        created() {
            if (this.message) {
                this.flash(this.type, this.message);
            }

            window.event.$on('flash', (type, message) => {
                this.flash(type, message);
            });
        },

        methods: {
            flash(type, message) {
                this.type = type;
                this.body = message;
                this.show = true;

                this.hide();
            },

            hide() {
                setTimeout(() => {
                   this.show = false;
                }, 3000);
            }
        }
    }
</script>

<style>
    .alert {
        position: fixed;
        right: 25px;
        bottom: 25px;
    }
</style>