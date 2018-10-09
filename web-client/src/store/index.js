import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

let state = {
    currentDate: null,
    hours: [],
    currentHour: null,
    processing: false,
    summary: {},
    recharge: false
}

let getters = {
    getCurrentDate(state) {
        return state.currentDate;
    },
    getHours(state) {
        return state.hours;
    },
    getCurrentHour(state) {
        return state.currentHour;
    },
    getProcessing(state) {
        return state.processing;
    },
    getSummary(state) {
        return state.summary;
    },
    getRecharge(state) {
        return state.recharge;
    }
}

let mutations = {
    changeDate(state, payload) {
        state.currentDate = payload.date;
    },
    changeHours(state, payload) {
        state.hours = payload.hours;
        state.currentHour = null;
    },
    selectHour(state, payload) {
        state.currentHour = payload.hour;
    },
    startProcessing(state) {
        state.processing = true;
    },
    stopProcessing(state) {
        state.processing = false;
    },
    setSummary(state, payload) {
        state.summary = payload;
    },
    setRecharge(state, value) {
        state.recharge = value;
    },
}

let actions = {
    fetchHours({ commit }, date) {

        commit('startProcessing');
        commit('changeDate', { date: date });

        Vue.http.get('appointments/' + date).then(response => {

            commit('stopProcessing');

            if (response.response == 'error') {
                return;
            }

            commit('changeHours', { hours: response.body.hours });
        });
    },
    saveHour({ commit }, hour) {

        commit('startProcessing');

        return new Promise((resolve, reject) => {

            Vue.http.post('appointments/create', hour).then(response => {
                    resolve(response.body);
                })
                .catch(error => {
                    reject(error);
                })
                .finally(() => {
                    commit('stopProcessing');
                });
        })
    },
    deleteHour({ commit }, id) {

        commit('startProcessing');

        return new Promise((resolve, reject) => {

            Vue.http.delete('appointments/delete/' + id).then(response => {
                    resolve(response.body);
                })
                .catch(error => {
                    reject(error);
                })
                .finally(() => {
                    commit('stopProcessing');
                });
        })
    }
}

export default new Vuex.Store({
    state: state,
    getters: getters,
    mutations: mutations,
    actions: actions
});