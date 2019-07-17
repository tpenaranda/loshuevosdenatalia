<template>
    <md-card-header class="bg-primary pt-1 pb-1">
        <div class="md-layout md-gutter md-alignment-center-center pb-1">
            <div class="md-layout-item md-size-15 text-center">
                <span class="md-display-1">🐰</span>
            </div>
            <div class="md-layout-item md-size-70 text-light">
                <div class="md-headline pt-1 pb-1 text-center">ARTESANALES<br>PERSONALIZADOS</div>
            </div>
            <div class="md-layout-item md-size-15 text-center">
                <span class="md-display-1">🍫</span>
            </div>
        </div>
        <div class="md-layout md-gutter md-alignment-center-center text-light text-center">
            <div class="md-layout-item md-size-100">
                <div class="md-title pb-2">¡Y muy ricos!</div>
            </div>
            <div class="md-layout-item md-size-100">
                <div class="md-body-1">Encargá yaaaa, que estamos a {{ days_from_easter_text }} de pascuas.</div>
            </div>
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
            easter_date: '2020-04-21',
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
