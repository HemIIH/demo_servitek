<template>
    <tr>
        <td>
            <a v-if="item.type == 'order'" :href="'/admin/order/' + item.id + '/show'" target="_blank">{{ item.id }}</a>
        </td>
        <td>
            <div v-if="item.type == 'order'">
                <div v-show="item.start == item.end">{{ item.start }}</div>
                <div v-show="item.start != item.end">{{ item.start + ' - ' + item.end }}</div>
            </div>
            <div v-else>
                <div v-if="editMode" class="form-group" :class="{'has-error': errors['items.' + index + '.start']}">
                    <datepicker name="start" v-model="item.start"></datepicker>
                </div>
                <div v-else>{{ item.start }}</div>
                <i v-if="errors['items.' + index + '.start'] && ! editMode" class="fa fa-exclamation-triangle text-danger"></i>
            </div>
        </td>
        <td>
            <div v-show="editMode" class="form-group" :class="{'has-error': errors['items.' + index + '.service']}">
                <input class="form-control input-sm" v-model="item.service">
            </div>
            <span v-show="! editMode">{{ item.service }}</span>
            <i v-if="errors['items.' + index + '.service'] && ! editMode" class="fa fa-exclamation-triangle text-danger"></i>
        </td>
        <td>
            <div v-if="item.type == 'order'">{{ item.quantity }}</div>
            <div v-else>
                <div v-if="editMode" class="form-group" :class="{'has-error': errors['items.' + index + '.quantity']}">
                    <input class="form-control input-sm input-width-sm" v-model="item.quantity">
                </div>
                <div v-else>{{ item.quantity }}</div>
            </div>
            <i v-if="errors['items.' + index + '.quantity'] && ! editMode" class="fa fa-exclamation-triangle text-danger"></i>
        </td>
        <td>
            <div v-if="item.type == 'order'">{{ item.unit }}</div>
            <div v-else>
                <div v-if="editMode" class="form-group" :class="{'has-error': errors['items.' + index + '.unit']}">
                    <input class="form-control input-sm input-width-sm" v-model="item.unit">
                </div>
                <div v-else>{{ item.unit }}</div>
            </div>
        </td>
        <td>
            <div>
                <div v-if="editMode" class="form-group" :class="{'has-error': errors['items.' + index + '.price']}">
                    <input class="form-control input-sm input-width-sm" v-model="item.price">
                </div>
                <div v-else>{{ item.price ? item.price + ' €' : '' }}</div>
            </div>
            <i v-if="errors['items.' + index + '.price'] && ! editMode" class="fa fa-exclamation-triangle text-danger"></i>
        </td>
        <td>
            <div v-show="editMode" class="form-group">
                <select class="form-control input-sm" v-model="item.tax_rate">
                    <option value="0">0 %</option>
                    <option value="7">7 %</option>
                    <option value="19">19 %</option>
                </select>
            </div>
            <div v-show="! editMode">{{ item.tax_rate }} %</div>
        </td>
        <td>
            <div v-show="editMode" class="form-group" :class="{'has-error': errors['items.' + index + '.discount']}">
                <input class="form-control input-sm" v-model="item.discount">
            </div>
            <span v-show="! editMode">{{ item.discount }} %</span>
            <i v-if="errors['items.' + index + '.discount'] && ! editMode" class="fa fa-exclamation-triangle text-danger"></i>
        </td>
        <td>
            <span v-if="item.price && item.quantity">
                {{ money(total()) }} €
            </span>
        </td>
        <td>
            <span v-if="editMode"><i @click="save" class="fa fa-save fa-lg pointer"></i></span>
            <span v-else><i @click="edit" class="fa fa-edit fa-lg pointer"></i></span>
            <span v-if="! deleted"><i @click="destroy($event)" class="fa fa-times fa-lg pointer"></i></span>
            <span v-else><i @click="revert($event)" class="fa fa-refresh fa-lg pointer"></i></span>
        </td>
    </tr>
</template>

<script>
    export default {
        data() {
            return {
                editMode: this.item.type == 'custom',
                deleted: false
            }
        },
        props: ['item', 'errors', 'index'],

        methods: {

            total() {
                return this.convert(this.item.price) * this.convert(this.item.quantity) * (1 - this.item.discount/100) * (1 + this.item.tax_rate/100)
            },

            save() {
                this.editMode = false;
            },

            edit() {
                this.editMode = true;
            },

            destroy(event) {
                this.deleted = 1;
                this.item.deleted = 1;

                $(event.target).parents('tr').addClass('line-deleted');
            },

            revert(event) {
                this.deleted = 0;
                this.item.deleted = 0;

                $(event.target).parents('tr').removeClass('line-deleted');
            },

            convert(value) {
                return parseFloat(value.replace(/,/, '.'))
            }

        }
    }
</script>