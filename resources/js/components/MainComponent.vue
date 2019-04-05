<template>
    <div>
        <form novalidate class="md-layout" @submit.prevent="submitData">
            <md-card class="md-layout-item">
                <md-card-header class="py-3">
                    <div class="md-headline">Anotate en la lista</div>
                    <div class="md-subhead">Te llamamos, coordinamos y te los llevamos a domicilio! <a href="//instagram.com/natimauro_">@natimauro_</a></div>
                </md-card-header>
                <md-card-content>
                    <div v-if="!loadingSkus && !sending">
                        <div v-for="(item, index) in order.skus" class="md-layout md-gutter md-alignment-center-center">
                            <div class="md-layout-item md-size-10 text-center" @click="switchFlavor(index)">
                                <svg v-if="item.data.flavor === 'NB'"width="25" height="25">
                                    <polygon points="0,0 25,25 0,25" stroke="brown" stroke-width="1" fill="brown" />
                                    <line x1="0" y1="0" x2="25" y2="0" stroke="black" stroke-width="1" />
                                    <line x1="25" y1="0" x2="25" y2="25" stroke="black" stroke-width="1" />
                                </svg>
                                <svg v-else width="25" height="25">
                                    <rect v-if="item.data.flavor === 'N'" width="25" height="25" stroke="brown" stroke-width="1" fill="brown" />
                                    <rect v-if="item.data.flavor === 'B'" width="25" height="25" stroke="black" stroke-width="1" fill="white" />
                                </svg>
                            </div>
                            <div class="md-layout-item md-size-30">
                                <md-field :class="getValidationClassForOrderSkuId(index)">
                                    <label :for="`order_sku_id[${index}]`">Tamaño</label>
                                    <md-select :name="`order_sku_id[${index}]`" :id="`order_sku_id[${index}]`" v-model="item.id" md-dense :disabled="sending">
                                        <md-option v-for="sku in skus" :key="sku.id" :value="sku.id">{{ sku.name }}</md-option>
                                    </md-select>
                                    <span class="md-error">Qué tamaño?</span>
                                </md-field>
                            </div>
                            <div class="md-layout-item md-size-40 pl-3">
                                <md-field :class="getValidationClassForText(index)" :md-counter="false">
                                    <label :for="`text[${index}]`">Texto</label>
                                    <md-input :name="`text[${index}]`" :id="`text[${index}]`" size="5" maxlength="5" v-model.trim="item.data.text" :disabled="sending" />
                                    <span class="md-error" v-if="!$v.order.skus.$each[index].data.text.required">Qué le escribimos?!?!?</span>
                                    <span class="md-error" v-else-if="!$v.order.skus.$each[index].data.maxlength">Ui, el máximo son 5 letras.</span>
                                </md-field>
                            </div>
                            <div class="md-layout-item md-size-20 py-0 text-right">
                                <span @click="deleteOrderSku(index)">
                                    <md-icon v-if="index || order.skus.length > 1" class="md-size-1x text-danger md-body-2">delete_forever</md-icon>
                                </span>
                                <span @click="addOrderSku">
                                    <md-icon v-if="index === order.skus.length - 1" class="md-size-1x text-info">add_box</md-icon>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div v-else class="text-center">
                        <md-progress-spinner :md-diameter="35" :md-stroke="3" md-mode="indeterminate"></md-progress-spinner>
                    </div>
                    <div v-if="order_total && !sending" class="md-layout md-gutter text-center border-bottom border-top p-1 mt-4 mb-2">
                        <div class="md-layout-item md-body-2 text-info">Total: $ {{ order_total }}</div>
                    </div>
                    <div class="md-layout md-gutter md-alignment-center">
                        <div class="md-layout-item md-size-25 text-center">
                            <md-icon class="md-size-1x">face</md-icon>
                        </div>
                        <div class="md-layout-item md-size-75">
                            <md-field :class="getValidationClassForName()" :md-counter="false">
                                <label for="name">Tu nombre</label>
                                <md-input name="name" maxlength="16" id="name" autocomplete="given-name" v-model.trim="order.user.name" :disabled="sending" />
                                <span class="md-error" v-if="!$v.order.user.name.required">Decime cual cual cual es tu nombre</span>
                                <span class="md-error" v-else-if="!$v.order.user.name.minlength">Tan cortito?</span>
                                <span class="md-error" v-else-if="!$v.order.user.name.maxlength">Revisar nombre</span>
                            </md-field>
                        </div>
                    </div>
                    <div class="md-layout md-gutter md-alignment-center">
                        <div class="md-layout-item md-size-25 text-center">
                            <md-icon class="md-size-1x">phone</md-icon>
                        </div>
                        <div class="md-layout-item md-size-30">
                            <md-field :class="getValidationClassForPhoneArea()" :md-counter="false">
                                <label>Área</label>
                                <md-input v-model="order.user.phone.area" maxlength="4" type="tel" :disabled="sending"></md-input>
                                <span class="md-error" >Revisar este número</span>
                            </md-field>
                        </div>
                        <div class="md-layout-item md-size-45">
                            <md-field :class="getValidationClassForPhoneNumber()" :md-counter="false">
                                <label>Número</label>
                                <md-input v-model="order.user.phone.number" maxlength="7" type="tel" :disabled="sending"></md-input>
                                <span class="md-error" >Revisar este número</span>
                            </md-field>
                        </div>
                    </div>
                </md-card-content>
                <div class="text-center">
                    <md-button type="submit" class="md-primary border mb-4 mt-2" :disabled="!submit_enabled">Quiero!</md-button>
                </div>
            </md-card>
            <md-progress-bar md-mode="indeterminate" v-if="sending" />
        </form>
        <md-dialog-alert
            :md-active.sync="formErrorDialog"
            md-content="Revisá el formulario. Algún dato no está bien."
            md-confirm-text="Cerrar">
        </md-dialog-alert>
        <md-dialog-alert
            :md-active.sync="requestSuccessDialog"
            md-content="Genial!<br>Tus huevos ya están encargados.<br>Te llamaremos en breve."
            md-confirm-text="Cerrar">
        </md-dialog-alert>
        <md-dialog-alert
            :md-active.sync="requestErrorDialog"
            md-content="Ups, hay un problemita. Intentá hacer el pedido más tarde, gracias!."
            md-confirm-text="Cerrar">
        </md-dialog-alert>
    </div>
</template>

<script>
    import { validationMixin } from 'vuelidate'
    import {
        between,
        integer,
        maxLength,
        minLength,
        minValue,
        required
    } from 'vuelidate/lib/validators'

    export default {
        name: 'MainComponent',
        mixins: [
            validationMixin
        ],
        components: {
        },
        data: () => ({
            order: {
                skus: [],
                user: {
                    name: null,
                    phone: {
                        area: '341',
                        country: '54',
                        number: null,
                    }
                },
                notes: null,
            },
            skus: [],
            loadingSkus: null,
            sending: false,
            formErrorDialog: false,
            requestErrorDialog: false,
            requestSuccessDialog: false
        }),
        validations: {
            order: {
                skus: {
                    required: true,
                    $each: {
                        id: {
                            required
                        },
                        data: {
                            text: {
                                required,
                                minLength: minLength(1),
                                maxLength: maxLength(5),
                            }
                        }
                    }
                },
                user: {
                    name: {
                      required,
                      minLength: minLength(3),
                      maxLength: maxLength(64)
                    },
                    phone: {
                      area: {
                        required,
                        integer,
                        minValue: minValue(0),
                        minLength: minLength(3),
                        maxLength: maxLength(4),
                      },
                      country: {
                        required,
                        integer,
                        minValue: minValue(0),
                        minLength: minLength(1),
                        maxLength: maxLength(2),
                      },
                      number: {
                        required,
                        integer,
                        minValue: minValue(0),
                        minLength: minLength(6),
                        maxLength: maxLength(7),
                      }
                    }
                }
            }
        },
        computed: {
            order_total() {
                let total = 0

                this.order.skus.forEach(orderSku => {
                    let sku = this.skus.find(sku => { return sku.id == orderSku.id })
                    if (sku) {
                        total += sku.price
                    }
                })

                return total
            },
            submit_enabled () {
                return !this.sending && !(this.$v.$invalid && this.$v.$dirty) && this.order.skus.length && !this.loadingSkus
            }
        },
        mounted () {
            this.getSkus()
        },
        methods: {
            getSkus() {
                this.loadingSkus = true
                this.axios.get('/api/skus').then((response) => {
                    this.skus = response.data
                    this.order.skus = [{
                        id: null,
                        data: {
                            flavor: 'N',
                            text: null
                        }
                    }]
                }).catch((error) => {
                    this.requestErrorDialog = true
                    this.order.skus = []
                }).finally((response) => {
                    this.loadingSkus = false
                })
            },
            switchFlavor(index) {
                if (this.order.skus[index].data.flavor === 'N') {
                    this.order.skus[index].data.flavor = 'B'
                } else if (this.order.skus[index].data.flavor === 'B') {
                    this.order.skus[index].data.flavor = 'NB'
                } else {
                    this.order.skus[index].data.flavor = 'N'
                }
            },
            deleteOrderSku(index) {
                if (this.sending) {
                    return false
                }
                this.order.skus.splice(index, 1)
            },
            addOrderSku(index) {
                if (this.sending) {
                    return false
                }
                this.order.skus.push({id: null, data: {flavor: 'N', text: null}})
                this.$v.$reset()
            },
            getValidationClassForName() {
                return this.returnValidationClass(this.$v.order.user.name)
            },
            getValidationClassForOrderSkuId(index) {
                return this.returnValidationClass(this.$v.order.skus.$each[index].id)
            },
            getValidationClassForText(index) {
                return this.returnValidationClass(this.$v.order.skus.$each[index].data.text)
            },
            getValidationClassForPhoneArea() {
                return this.returnValidationClass(this.$v.order.user.phone.area)
            },
            getValidationClassForPhoneNumber() {
                return this.returnValidationClass(this.$v.order.user.phone.number)
            },
            returnValidationClass(field) {
                if (field) {
                    return { 'md-invalid': field.$invalid && field.$dirty }
                }
            },
            postOrder () {
                this.sending = true
                this.axios.post('/api/orders', {data: this.order}).then((response) => {
                    this.requestSuccessDialog = true
                    this.$v.$reset()
                    this.order.skus = [{ id: null, data: { flavor: 'N', text: null }}]
                }).catch((error) => {
                    this.requestErrorDialog = true
                }).finally((response) => {
                    this.sending = false
                })
            },
            submitData () {
                this.$v.$touch()

                if (this.$v.$invalid) {
                    return this.formErrorDialog = true
                }

                this.postOrder()
            }
        }
    }
</script>

<style lang="scss" scoped>
    .md-progress-bar {
        position: absolute;
        top: 0;
        right: 0;
        left: 0;
    }
</style>
