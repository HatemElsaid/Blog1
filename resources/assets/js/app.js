
// /**
//  * First we will load all of this project's JavaScript dependencies which
//  * includes Vue and other libraries. It is a great starting point when
//  * building robust, powerful web applications using Vue and Laravel.
//  */

// require('./bootstrap');

// window.Vue = require('vue');

// /**
//  * Next, we will create a fresh Vue application instance and attach it to
//  * the page. Then, you may begin adding components to this application
//  * or customize the JavaScript scaffolding to fit your unique needs.
//  */

// Vue.component('example', require('./components/Example.vue'));

// const app = new Vue({
//     el: '#app'
// });
 

// $(document).ready(function(e){
 

//  $('.like').click(function(e){
//      e.preventDefault();

//  var  like = e.target.previousElementSibling==null;
//  var postid = event.target.parentNode.dataset['postid'];

//  console.log(postid)
//  var data = {
//      isLike: like,
//      user_id: {{Auth::user()->id}},
//      post_id:postid
//  }

//  axios.post('/like',data).then(response=>{
//      console.log(response['data'])
//  })

//  })
// })

setTimeout(function() {
    let visitCount = document.getElementById('postCountValue').value;
    let visitCountPlusOne = parent(visitCount)+1;
    document.getElementById('postCountValue').value = visitCountPlusOne;
    let $var = $('#postCountValue')
    $.ajax({
        url:$var.prop("{{route('posts.view',['id'=>$post_id])}}"),
        method:PUT,
        data:$var.serialize()

    });
}, 1000);
