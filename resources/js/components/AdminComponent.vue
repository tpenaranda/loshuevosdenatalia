<template>
    <div class="container">
        <div class="row m-3">
            <div class="col text-center my-auto p-2">
                <toggle-button
                    :font-size="15"
                    :height="30"
                    :width="100"
                    :sync="true"
                    :disabled="storeStatusButtonDisabled || storeOpen === null"
                    :labels="{checked: 'Abierto', unchecked: 'Cerrado'}"
                    v-model="storeOpen"
                    @input="storeStatusButtonInput"
                />
            </div>
            <div class="col text-center my-auto p-2">
                <button type="button" class="btn btn-success" @click="logout">Logout</button>
            </div>
        </div>
        <div class="col-md-12">
            <md-table v-model="orders" md-sort="id" md-sort-order="desc" md-card>
              <md-table-toolbar>
                <h1 class="md-title">Pedidos</h1>
              </md-table-toolbar>
              <md-table-row slot="md-table-row" slot-scope="{ item }">
                <md-table-cell md-label="#" md-sort-by="id" md-numeric>{{ item.id }}</md-table-cell>
                <md-table-cell md-label="Fecha">{{ item.created_at | formatCreatedAt }}</md-table-cell>
                <md-table-cell md-label="Nombre">{{ item.user.name }}</md-table-cell>
                <md-table-cell md-label="Teléfono">{{ item.user.phone }}</md-table-cell>
                <md-table-cell md-label="Huevos" class="text-center">{{ item.skus.length }}</md-table-cell>
                <md-table-cell md-label="Detalle">
                    <div v-for="sku in item.skus">{{ sku | formatSku }}</div>
                </md-table-cell>
              </md-table-row>
            </md-table>
        </div>
        <div v-if="totalSkus" class="col-md-12 text-right pr-4 pt-2">
            <span class="md-subheading">Total: {{ totalSkus }} huevos</span>
        </div>
    </div>
</template>

<script>
    import moment from 'moment-timezone'
    import { ToggleButton } from 'vue-js-toggle-button'

    export default {
        name: 'AdminComponent',
        filters: {
            formatCreatedAt (value) {
                let output = moment.tz(value, 'UTC').tz(moment.tz.guess()).locale('es').calendar()

                return output.substr(0,1).toUpperCase() + output.substr(1);
            },
            formatSku (sku) {
                return `${sku.name} (${sku.data['text']}) [${sku.data['flavor']}]`
            }
        },
        data: () => ({
            errorLoadingOrders: false,
            loadingOrders: null,
            orders: [],
            storeOpen: null,
            storeStatusButtonDisabled: false,
            totalSkus: null
        }),
        components: {
            ToggleButton
        },
        mounted () {
            this.getOrders()
            this.getStore()
        },
        methods: {
            logout() {
                this.axios.post('/logout').then((response) => {
                    window.location.href = '/'
                })
            },
            storeStatusButtonInput(value) {
                this.storeStatusButtonDisabled = true
                this.axios.put(`/api/store/${value ? 'open' : 'close'}`).then((response) => {
                    this.storeOpen = response.data.open
                    this.storeStatusButtonDisabled = false
                })
            },
            getOrders() {
                this.loadingOrders = true
                this.axios.get('/api/orders').then((response) => {
                    this.orders = response.data
                    this.orders.forEach(order => this.totalSkus += order.skus.length)
                }).catch((error) => {
                    this.errorDialogOrders = true
                }).finally((response) => {
                    this.loadingOrders = false
                })
            },
            getStore() {
                this.axios.get('/api/store').then((response) => {
                    this.storeOpen = response.data.open
                })
            }
        }
    }
</script>

<style lang="scss" scoped>
  label {
    display: inline-block;
    margin: 0;
  }
</style>
