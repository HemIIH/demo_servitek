<template>
    <div class="nav-tabs-custom" style="border: 1px solid #d3e0e9;">
        <ul class="nav nav-tabs">
            <li :class="{'active' : ! order.time_recorded }"><a href="#calculation" data-toggle="tab">{{trans('admin.Kalkulation')}}</a></li>
            <li :class="{'active' : order.time_recorded }"><a href="#accounting" data-toggle="tab">{{trans('admin.Abrechnung')}}</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane" :class="{'active' : order.time_recorded }" id="accounting">
                <div v-if="order.time_recorded">
                    <div class="row">
                        <div class="col-md-6">
                            <strong>{{trans('admin.Eingesetzte Mitarbeiter')}}:</strong> {{ order.staff_planned }}
                        </div>
                        <div class="col-md-6">
                            <strong>{{trans('admin.Zeit gesamt')}} :</strong> {{ hour(order.total_min/60) + trans('admin.Stunden') }}
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col-md-6">
                            <form-wrapper :action="'/api/order/' + order.id + '/accounting'">
                                <template slot-scope="form">
                                    <label>{{trans('admin.Sonstige Kosten')}}</label>
                                    <div class="input-group" :class="{ 'has-error': form.errors.other_costs }">
                                        <input class="form-control input-sm" name="other_costs" :value="money(order.other_costs)">
                                        <span class="input-group-btn"><button class="btn btn-sm btn-default"><i class="fa fa-floppy-o"></i></button></span>
                                    </div>
                                </template>
                            </form-wrapper>
                        </div>
                    </div>

                    <br>

                    <table class="table">
                        <tr>
                            <td><strong>{{trans('admin.Einnahmen')}} :</strong></td>
                            <td>{{ money(order.total_income) + ' €'}}</td>
                        </tr>
                        <tr>
                            <td><strong>{{trans('admin.Kosten')}} :</strong></td>
                            <td>{{ money(order.total_cost + order.other_costs) + ' €'}}</td>
                        </tr>
                        <tr>
                            <td><strong>{{trans('admin.Gewinn')}} :</strong></td>
                            <td>{{ money(order.total_income - (order.total_cost + order.other_costs)) + ' €'}}</td>
                        </tr>
                    </table>
                </div>
                <div v-else>
                    {{trans('admin.Zeiterfassung noch nicht abgeschlossen')}}
                </div>
            </div>

            <div class="tab-pane" :class="{'active' : ! order.time_recorded }" id="calculation">
                <form-wrapper :action="'/api/order/' + order.id + '/calculation'">
                    <template slot-scope="form">
                        <strong>{{trans('admin.Eingeplante Mitarbeiter')}} :</strong> {{ order.staff_planned }} {{trans('admin.von')}} {{ order.staff_required }}
                        <div class="row margin-t-10">
                            <div class="col-md-4 form-group" :class="{'has-error': form.errors.hours }">
                                <label>{{trans('admin.Stunden')}}</label>
                                <input class="form-control input-sm" name="hours" :value="order.calculation != null ? hour(order.calculation.hours) : '0'">
                            </div>
                            <div class="col-md-4 col-md-offset-1 form-group" :class="{'has-error': form.errors.other_costs }">
                                <label>{{trans('admin.Sonstige Kosten')}}</label>
                                <input class="form-control input-sm" name="other_costs" :value="order.calculation != null ? money(order.calculation.other_costs) : '0'">
                            </div>
                            <div class="col-md-3 text-right">
                                <br>
                                <input type="submit" :value="trans('admin.Berechnen')" class="btn btn-default btn-sm">
                            </div>
                        </div>
                    </template>
                </form-wrapper>

                <div v-if="order.calculation != null && order.staff_planned" class="row margin-t-10">
                    <div class="col-md-4">
                        <h4>{{trans('admin.Vorkalkulation')}}</h4>
                    </div>
                    <div class="col-md-8">
                        <table class="table margin-t-10">
                            <tr>
                                <td><strong>{{trans('admin.Einnahmen')}} :</strong></td>
                                <td>{{ order.calculation != null ? money(order.calculation.total_income) + ' €' : '' }}</td>
                            </tr>
                            <tr>
                                <td><strong>{{trans('admin.Kosten')}}:</strong></td>
                                <td>{{ order.calculation != null ? money(order.calculation.total_costs) + ' €' : '' }}</td>
                            </tr>
                            <tr>
                                <td><strong>{{trans('admin.Gewinn')}} :</strong></td>
                                <td>{{ order.calculation != null ? money(order.calculation.total_income - order.calculation.total_costs) + ' €' : '' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        data() {
            return {
                order: {}
            }
        },

        props: ['model'],

        methods: {
            getOrder() {
                axios.get('/api/order/' + this.model.id).then((response) =>
                        this.order = response.data
                );
            }
        },

        created() {
            this.getOrder();

            this.$on('form.submitted', () => {
                this.getOrder();
            })
        }
    }
</script>