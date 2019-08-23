<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6">
                    <div class="panel-title">{{ order.title }}</div>
                    <div v-if="order.status == 'canceled'" class="label label-warning margin-l-10">{{trans('admin.Storniert')}}</div>
                </div>
                <div class="col-md-6 text-right">
                    <a v-if="order.status != 'canceled'" @click="cancelOrder" class="btn btn-sm btn-danger">{{trans('admin.Stornieren')}}</a>
                    <a v-else @click="activateOrder" class="btn btn-sm btn-success">{{trans('admin.Aktivieren')}}</a>

                    <a v-if="! order.parent_id" @click="duplicateOrder" class="btn btn-sm btn-success">{{trans('admin.Duplizieren')}}</a>
                    <a @click="copyOrder" class="btn btn-sm btn-primary">{{trans('admin.Kopieren')}}</a>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-2">
                    <p>
                        <strong>{{trans('admin.Auftragsnr')}} :</strong> {{ order.id }}
                    </p>
                    <p>
                        <strong>{{trans('admin.Datum')}} :</strong> {{ order.start == order.end ? order.start : order.start + ' bis ' + order.end }}
                    </p>
                    <p>
                        <strong>{{trans('admin.Treffpunkt')}}:</strong> {{ order.meeting_time + trans('admin.Uhr')+' - ' + order.meeting_point }}
                    </p>
                </div>
                <div class="col-md-2">
                    <p>
                        <strong>{{trans('admin.Kunde')}}:</strong> <a :href="'/admin/client/' + order.client.id + '/show'">{{ order.client.name }}</a>
                    </p>
                    <p>
                        <strong>{{trans('admin.Startzeit')}}:</strong> {{ order.start_time }} {{trans('admin.Uhr')}}
                    </p>
                    <p>
                        <strong>{{trans('admin.Einsatzort')}}:</strong> {{ order.work_location }}
                    </p>
                </div>
                <div class="col-md-3">
                    <p>
                        <strong>{{trans('admin.Einsatzinfos')}}:</strong> <br>
                        {{ order.requirements }}
                    </p>
                </div>
                <div class="col-md-3">
                    <div v-if="order.parent || order.children.length">
                        <p>
                            <strong>{{ order.is_parent ? trans('admin.Zugehörige Unteraufträge') : trans('admin.Zugehöriger Hauptauftrag') }}</strong>
                        </p>
                        <ul class="list-group" style="max-width:280px;">
                            <li v-if="order.children" v-for="child in order.children" class="list-group-item">
                                <div>
                                    <a :href="'/admin/order/' + child.id + '/show'">{{trans('admin.Auftragsnr')}}. {{ child.id + ' - ' + child.title }}</a>
                                </div>
                                {{ child.start }} - {{trans('admin.Beginn')}}: {{ child.start_time }} {{trans('admin.Uhr')}}
                            </li>
                            <li v-if="order.parent" class="list-group-item">
                                <div>
                                    <a :href="'/admin/order/' + order.parent.id + '/show'">{{trans('admin.Auftragsnr')}}. {{ order.parent.id + ' - ' + order.parent.title }}</a>
                                </div>
                                {{ order.start }} - {{trans('admin.Beginn')}}: {{ order.start_time }} {{trans('admin.Uhr')}}
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="pull-right">
                        <i @click="editOrder" class="fa fa-pencil pointer"></i>
                    </div>
                    <p>
                        <strong>{{trans('admin.Angelegt von')}}:</strong><br>
                         {{ order.user.name }}
                    </p>
                    <p>
                        <strong>{{trans('admin.Angelegt am')}}:</strong><br>
                        {{ moment(order.created_at).format('lll') }} {{trans('admin.Uhr')}}
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                order: Object.assign({}, this.model)
            }
        },
        props: ['model'],

        methods: {

            editOrder() {
                modal('Edit Order Modal', trans('admin.Auftrag bearbeiten'), {'order': this.order});
            },

            copyOrder() {
                modal('Copy Order Modal', trans('admin.Auftrag kopieren'), {'order': this.order});
            },

            duplicateOrder() {
                modal('Duplicate Order Modal', trans('admin.Unterauftrag anlegen'), {'order': this.order});
            },

            cancelOrder() {

                swal({
                    title: trans('admin.Auftrag stornieren?'),
                    confirmButtonText: trans('admin.Stornieren!')
                }).then(() => {
                    axios.post('/api/order/' + this.order.id + '/cancel').then(() => {
                        flash(trans('admin.Auftrag storniert'), 'success')
                        this.reloadOrder()
                    }).catch(() => flash(trans('admin.Auftrag konnte nicht storniert werden'), 'error'));
                });
            },

            activateOrder() {

                swal({
                    title: trans('admin.Auftrag aktiveren?'),
                    confirmButtonText: trans('admin.Aktivieren!')
                }).then(() => {
                    axios.post('/api/order/' + this.order.id + '/activate').then(() => {
                        flash(trans('admin.Auftrag aktiviert'), 'success')
                        this.reloadOrder()
                    }).catch(() => flash(trans('admin.Auftrag konnte nicht aktiviert werden'), 'error'));
                });
            },

            reloadOrder() {
                axios.get('/api/order/' + this.model.id).then((response) =>
                        this.order = response.data
                );
            }
        },

        created() {
            events.$on(['order.created', 'order.updated'], this.reloadOrder);
        }
    }
</script>