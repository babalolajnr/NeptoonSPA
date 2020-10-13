export default {
    state: {
        user: null,
    },

    getters: {
        getUserFromStore: state => {
            return state.user
        }
    },

    actions: {
        getAuthUser({ commit }) {
            return new Promise((resolve, reject) => {
                axios.get('/api/user').then((response) => {
                    commit("GET_USER", response.data[0])
                }).catch((err) => {
                    console.log(err)
                })
            })
        }

    },

    mutations: {
        GET_USER: (state, data) => {
            state.user = data
        }
    }
}