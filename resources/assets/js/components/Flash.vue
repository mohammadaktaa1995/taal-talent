<template>
    <base-alert :type="type" icon="ni ni-like-2" v-show="show" dismissible>
        <span slot="text"> {{ body }}</span>
    </base-alert>
</template>

<script>
    export default {
        name: "Flash",
        props: ['message', 'type'],
        data() {
            return {
                show: false,
                body: ''
            }
        },

        created() {
            if (this.message) {
                console.log(this.message)
                this.flash(this.message)
            }
            window.events.$on('flash', (message) => this.flash(message))
        },

        methods: {

            flash(message) {
                this.show = true
                this.body = message

                setTimeout(() => {
                    this.hide()
                }, 3000)
            },
            hide() {
                this.show = false
            }
        }
    }
</script>

<style scoped>
    .spacing {
        position: fixed;
        right: 25px;
        bottom: 25px;
    }
</style>