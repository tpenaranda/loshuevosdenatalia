<template>
    <md-card-header class="p-0">
        <div class="md-display-1 text-center p-2 text-light bg-primary">ARTESANALES Y PERSONALIZADOS</div>
        <div class="md-body-1 text-center pb-2 text-light bg-primary">
            ¡Estamos a {{ days_from_easter_text }} de pascuas!
        </div>
    </md-card-header>
</template>

<script>
    import moment from 'moment-timezone'

    export default {
        name: 'HeaderComponent',
        components: {
        },
        filters: {
        },
        data: () => ({
            easter_date: '2019-04-20',
        }),
        computed: {
            days_from_easter_text () {
                return moment(this.easter_date).locale('es').fromNow(true)
            }
        },
        mounted () {
        },
        methods: {
        }
    }
</script>

<style lang="scss" scoped>
</style>
