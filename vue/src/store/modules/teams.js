// initial state
const state = () => ({
  items: [],
  options: {
    names: [],
    locations: [],
    stadiums: []
  },
  results: []
})

// getters
const getters = {
  // loadItems: function(state) {
  //   return state.items;
  // },
  // loadFilters(state) {

  // }
}

// actions
const actions = {
  // getAllProducts({ commit }) {
  //   shop.getProducts(products => {
  //     commit('setProducts', products)
  //   })
  // }

  // getItems({ commit }) {
  //   shop.getProducts(products => {
  //     commit('setProducts', products)
  //   })
  // }
}

// mutations
const mutations = {
  setTeams(state, teams) {
    state.items = teams;
  },

  // decrementProductInventory(state, { id }) {
  //   const product = state.all.find(product => product.id === id)
  //   product.inventory--
  // }
}

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}