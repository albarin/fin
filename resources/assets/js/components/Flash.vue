<template>
    <div class="alert notification" v-bind:class="type" v-show="show">
        {{ body }}
    </div>
</template>

<script>
    export default {
        props: [
            'kind',
            'message'
        ],

        data() {
            return {
                type: 'is-success',
                body: '',
                show: false,
            }
        },

        created() {
            if (this.message) {
                this.flash(this.kind, this.message);
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