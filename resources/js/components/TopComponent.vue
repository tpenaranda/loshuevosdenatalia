<template>
    <div id="main_image" class="md-alignment-center-center text-center">
        <div class="more-information">
            <md-button class="md-dense md-raised md-primary" @click.prevent="detailsDialog = true">Detalles</md-button>
        </div>
        <md-dialog-alert
            :md-active.sync="detailsDialog"
            :md-content="detailsContent"
            md-confirm-text="Joya">
        </md-dialog-alert>
    </div>
</template>

<script>
    export default {
        name: 'TopComponent',
        components: {
        },
        filters: {
        },
        data: () => ({
            detailsDialog: false,
            detailsContent: "Los huevos están hechos con cocholate <i>Mapsacuber</i>, semiamargo y blanco.<br><br>Rellenos de:<ul><li>Confites frutales</li><li>Confites huesitos</li><li>Confites de chocolate</li><li>Caramelos masticables</li></ul>Pequeño: 10cm ($80)<br>Grande: 12cm ($120)<br>Gigante: 30cm ($1050)<br><br>Envíos a domicilio.<br>341-2770962<br><br>Nati",
        }),
        computed: {
        },
        mounted () {
        },
        methods: {
        }
    }
</script>

<style lang="scss" scoped>
    #main_image {
        background: url(/images/easter_eggs.jpg);
        background-size: cover;
        background-repeat: no-repeat;
        position: relative;
        height: 65vh;
    }
    .more-information {
        position: absolute;
        bottom: 2px;
    }
</style>
