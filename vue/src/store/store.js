import { createStore } from 'vuex';

const store = createStore({
    state() {
        return {
            count: 0,
            content: null
        }
    },
    getters: { // = computed properties

    },
    mutations: {
        increment(state) {
            state.count++
        },
        load(state) {
            state.content = state;
        }
    },

});

export default store;