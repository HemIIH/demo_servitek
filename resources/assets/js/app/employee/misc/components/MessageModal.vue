<template>
    <form-wrapper :action="'/api/e/message'" enctype="multipart/form-data">
        <template slot-scope="form">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-5 form-group" :class="{'has-error': form.errors.subject }">
                            <label>{{trans('admin.Betreff')}}</label>
                            <input class="form-control input-sm" name="subject" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 form-group" :class="{'has-error': form.errors.topic }">
                            <label>{{trans('admin.Bereich')}}</label>
                            <select name="topic" class="form-control input-sm" v-model="email" required>
                                <option value="">{{trans('admin.Bitte auswählen')}}</option>
                                <option value="personal@servite.de">{{trans('admin.Personal')}}</option>
                                <option value="personal@servite.de">{{trans('admin.Lohnbuchhaltung')}}</option>
                                <option value="dispo@servite.de">{{trans('admin.Einsätze - Köln')}}</option>
                                <option value="dpergola@servite.de">{{trans('admin.Einsätze - Düsseldorf')}}</option>
                                <option value="pmonfared@servite.de">{{trans('admin.Feedback zur Software')}}</option>
                                <option value="info@servite.de">{{trans('admin.Sonstiges')}}</option>
                            </select>
                        </div>
                        <div v-if="email" class="col-md-5 col-md-offset-1">
                            <label>{{trans('admin.E-Mail')}}</label>
                            <p v-text="email"></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-10 form-group" :class="{'has-error': form.errors.body }">
                            <textarea name="body" cols="30" rows="10" class="form-control input-sm" placeholder="Ihre Nachricht" required></textarea>
                        </div>
                    </div>
                    <input type="file" name="attachment">
                </div>
            </div>

            <submit-button class="pull-right btn-md btn-success" text="Absenden" :loading="form.loading"></submit-button>
        </template>
    </form-wrapper>
</template>

<script>
    export default {
        data() {
            return {
                email: ''
            }
        },

        created() {
            this.$on('form.submitted', () => {
                flash(trans('Anfrage verschickt!'));

                this.$parent.$emit('close')
            })
        }
    }
</script>