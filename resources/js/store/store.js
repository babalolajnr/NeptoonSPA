export default {
    state:{
        user: null,
    },

    getters: {
        getUserFromStore: state => {
            return state.user
        }
    },

    actions: {
        getAuthUser: (context) => {
            axios.get('/api/user').then((response) => {
                // this.user = response.data[0]
                context.commit("GET_USER", response.data[0])
                // console.log(response.data[0].firstName)
            }).catch((err) =>{
                console.log(err)
            })
        },

    },

    mutations: {
        GET_USER: (state, data) => {
             state.user = data
        }
    }
}