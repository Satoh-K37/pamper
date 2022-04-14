// import InfiniteLoading from 'vue-infinite-loading'; // ライブラリの読み込み
// Vue.component('infinite-loading', InfiniteLoading); // コンポーネント化

// new Vue({
//     el: '#recipe',
//     data: {
//       // DBから取得する時どこまで取得したかを確認する目印
//       page: 0,
//       // 取得したデータを格納し、画面表示するための配列
//       recipes: [],
//     },
//   methods: {
//     // viewから呼び出される変数
//     fetchRecipes($state) {
//       // すでに取得したレシピのIDリストを取得
//       let fetchRecipeIdList = this.fetchRecipeIdList();
//             // 指定したURLのパラメターを取得？クエリパラメータを指定。第二引数にオプションを指定
//             axios.get('/recipe', {
//               params: {
//                 // 一度取得したデータを再度取得することがないようにするためのIDの配列
//                 fetchRecipeIdList: JSON.stringify(fetchRecipeIdList),
//                 // データの取得位置の目印
//                 page: this.page
//                 }
//             })
//             // レスポンスのデータが１つ以上ある場合は、無限スクロールを継続する
//             .then(response => {
//                 if (response.data.recipes.length) {
//                     this.page++;
//                     response.data.recipes.forEach (value => {
//                         this.recipes.push(value);
//                     });
//                     $state.loaded();
//                 } else {
//                     $state.complete();
//                 }
//             })
//             .catch(error => {
//                 console.log(error);
//             })
//         },

//           fetchRecipeIdList() {
//             let fetchRecipeIdList = [];
//             for (let i = 0; i < this.recipes.length; i++) {
//               fetchRecipeIdList.push(this.recipes[i].id);
//             }
//             return fetchRecipeIdList;
//         }
//     }
// });


// // import Vue from 'vue'

// // Vue.directive('animal-scroll', {
// //     inserted: function(el, binding) {
// //         let f = function(evt) {
// //             if (binding.value(evt, el)) {
// //                 window.removeEventListener('scroll', f)
// //             }
// //         }
// //         window.addEventListener('scroll', f)
// //     }
// // })