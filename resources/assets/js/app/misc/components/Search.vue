<template>
    <div class="navbar-form navbar-left" @mouseleave="cancel">
        <div class="search-wrapper form-group">
            <input class="form-control" id="navbar-search-input" :placeholder="trans('admin.Suche')" v-model="term"
                   @keydown.enter='enter'
                   @keydown.down.stop='down'
                   @keydown.up.stop='up'
                   @keydown.esc='cancel'
                   @input='search'
            >
            <div v-if="results.length" class="search-input-group">
                <ul class="suggestions">
                    <li v-for="(result, index) in results" class="pointer" :class="{'active': isActive(index)}">
                        <div v-if="result.employee">
                            <a :href="'/admin/employee/' + result.id + '/show'">{{ result.name }}</a>
                            <span class="pull-right small text-muted">{{ trans('admin.Mitarbeiter') }}</span>
                        </div>
                        <div v-if="result.client">
                            <a :href="'/admin/client/' + result.id + '/show'">{{ result.name }}</a>
                            <span class="pull-right small text-muted">{{ trans('admin.Kunde') }}</span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                term: '',
                current: -1,
                results: {
                    employees: {},
                    clients: {}
                },
                searchlable: trans('admin.Suche'),
            }
        },
        methods: {

            search() {

                if (this.term.length < 2) {
                    return;
                }

                axios.post('/api/search/perform', {'term': this.term}).then((response) => this.results = response.data);
            },

            // When up arrow pressed while suggestions are open
            up () {
                if (this.current > 0) {
                    this.current--
                } else {
                    this.current = -1
                }
            },

            // When down arrow pressed while suggestions are open
            down () {
                if (this.current < this.results.length - 1) {
                    this.current++
                }
            },

            enter() {
                if (this.current >= 0 && this.results[this.current]) {
                    if (this.results[this.current].client) {
                        window.location = '/admin/client/' + this.results[this.current].id + '/show'
                    }

                    if (this.results[this.current].employee) {
                        window.location = '/admin/employee/' + this.results[this.current].id + '/show'
                    }
                }
            },

            cancel() {
                Object.assign(this.$data, this.$options.data());
            },

            isActive (index) {
                return index === this.current
            }
        }
    }
</script>


<style>
    .search-input-group {
        background-color: #f9fafc;
        color: #99a9bf;
        vertical-align: middle;
        display: table-cell;
        position: relative;
        border-radius: 4px;
        padding: 0 10px;
        white-space: nowrap;
    }

    .suggestions {
        position: absolute;
        left: 0;
        top: 110%;
        margin: 0;
        background-color: #fff;
        border: 1px solid #d3dce6;
        width: 240px;
        padding: 6px 0;
        z-index: 10;
        border-radius: 2px;
        max-height: 280px;
        box-sizing: border-box;
        overflow: auto;
        box-shadow: 0 0 6px 0 rgba(0, 0, 0, .04), 0 2px 4px 0 rgba(0, 0, 0, .12);
    }

    .suggestions li {
        list-style: none;
        line-height: 36px;
        padding: 0 10px;
        margin: 0;
        color: #475669;
        font-size: 14px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .suggestions li.active {
        background: lightgrey;
    }
</style>