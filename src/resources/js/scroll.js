import InfiniteLoading from 'vue-infinite-loading'; // ライブラリの読み込み
Vue.component('infinite-loading', InfiniteLoading); // コンポーネント化

new Vue({
    el: '#recipe',
    data: {
        page: 0, // レシピテーブルのOffsetを指定するための変数
        recipes: [], // レシピを格納
    },
    methods: {
        fetchRecipes($state) {
            let fetchRecipeIdList = this.fetchRecipeIdList(); // すでに取得したレシピのIDリストを取得

            axios.get('/recipe', {
                params: {
                    fetchRecipeIdList: JSON.stringify(fetchRecipeIdList),
                    page: this.page
                }
            })
            .then(response => {
                if (response.data.recipes.length) {
                    this.page++;
                    response.data.recipes.forEach (value => {
                        this.recipes.push(value);
                    });
                    $state.loaded();
                } else {
                    $state.complete();
                }
            })
            .catch(error => {
                console.log(error);
            })

        },

          fetchRecipeIdList() {
            let fetchRecipeIdList = [];
            for (let i = 0; i < this.recipes.length; i++) {
                fetchRecipeIdList.push(this.recipes[i].id);
            }
            return fetchRecipeIdList;
        }
    }
});


// import Vue from 'vue'

// Vue.directive('animal-scroll', {
//     inserted: function(el, binding) {
//         let f = function(evt) {
//             if (binding.value(evt, el)) {
//                 window.removeEventListener('scroll', f)
//             }
//         }
//         window.addEventListener('scroll', f)
//     }
// })