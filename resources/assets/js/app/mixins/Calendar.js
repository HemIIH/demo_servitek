export default {
    data() {
        return {
            employee: '',
            client: '',
            location: '',
            orders: [],
            timeoffs: [],
            start: this.startDate
        }
    },
    props: ['employees', 'clients', 'startDate', 'locations'],

    methods: {

        newOrder(date) {
            let data = {
                'startDate': moment(date).format('L'),
                'clients': this.clients
            }

            modal('New Order Modal', trans('admin.Neuer Auftrag'), data);
        },

        add(unit) {
            this.start = moment(this.start).add(1, unit).format();

            this.getOrders();
        },

        sub(unit) {
            this.start = moment(this.start).subtract(1, unit).format();

            this.getOrders();
        },

        getOrderStatus(order) {
            if (order.status == 'canceled') {
                return 'order-canceled';
            }

            if (order.staff_planned >= order.staff_required) {
                return 'order-filled';
            }

            return 'order-unfilled';
        },

        highlightTimeOff(type) {
            switch (type) {
                case 'Urlaub': return 'bg-blue';
                case 'Fehltag': return 'bg-orange';
                default: return 'bg-red';
            }
        },

        isToday(date) {
            return moment(date).format('l') == moment().format('l');
        }
    },
    created() {
        this.getOrders();

        events.$on(['order.created', 'order.updated', 'personal.updated'], this.getOrders);
    }
}