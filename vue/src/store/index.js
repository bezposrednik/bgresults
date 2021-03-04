import { createStore } from 'vuex';
import teams from './modules/teams'
import locations from './modules/locations'

const store = createStore({
    modules: {
        teams,
        locations
    }
});

export default store;