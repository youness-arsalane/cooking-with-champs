import { createStore } from 'vuex'

// Create a new store instance.
const store = createStore({
    state () {
        return {
            loggedIn: false,
            user: {}
        }
    },

    actions: {
        setLoggedIn (context) {
            context.commit('setLoggedIn')
        },
        
        setUser(context, user) {
            context.commit('setUser', user)
        }
    },

    getters: {
        getUser (state) {
            return state.user
        },
        
        getLoggedIn (state) {
            return state.loggedIn
        },
    },

    mutations: {
        setLoggedIn (state) {
            state.loggedIn = true
        },

        setUser (state, user) {
            state.user = user
        }
    }
})

export default store;
