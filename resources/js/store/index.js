import { createStore } from 'vuex'

// Create a new store instance.
const store = createStore({
    state () {
        return {
            loggedIn: false,
            user: {},
            fav: []
        }
    },

    actions: {
        setLoggedIn (context) {
            context.commit('setLoggedIn')
        },
        
        setUser(context, user) {
            context.commit('setUser', user)
        },

        markFav(context, id) {
            context.commit('markFav', id)
        }
    },

    getters: {
        getUser (state) {
            return state.user
        },
        
        getLoggedIn (state) {
            return state.loggedIn
        },

        getFavourite (state) {
            return state.fav
        },
    },

    mutations: {
        setLoggedIn (state) {
            state.loggedIn = true
        },

        setUser (state, user) {
            state.user = user
        },

        markFav(state, id) {
            state.fav.push(id)
        }
    }
})

export default store;
