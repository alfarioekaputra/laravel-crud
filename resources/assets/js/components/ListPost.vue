<template>
    <div>
        <br/>
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Content</th>
                    <th scope="col">Author</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(post, index) in posts" :key="index">
                    <th scope="row">{{post.id}}</th>
                    <td>{{post.title}}</td>
                    <td>{{post.content}}</td>
                    <td>{{post.author}}</td>
                    <td>
                        <router-link :to="{name: 'editPost', params: {id: post.id}}" class="btn btn-warning">Edit</router-link>
                        <a id="delete" class="btn btn-danger" v-on:click="deletePost(post.id, index)">Delete</a>
                    </td>
                </tr>
            </tbody>
        </table>
        
         <paginate
                :page-count="pageCount"
                :click-handler="fetch"
                :prev-text="'Prev'"
                :next-text="'Next'"
                :container-class="'pagination'">
        </paginate>
    </div>
</template>

<script>
export default {
  data: function() {
    return {
      posts: [],
      pageCount: 1,
      endpoint: 'api/posts?page='
    };
  },

  mounted() {
    var app = this;
    var page = 1;
    axios.get(this.endpoint + page).then(({ data }) => {
      app.posts = data.data;
      app.pageCount = data.meta.last_page;
    });
  },

  methods: {
    fetch(page = 1) {
      var app = this;
      axios.get(this.endpoint + page).then(({ data }) => {
        app.posts = data.data;
        app.pageCount = data.meta.last_page;
      });
    },
    deletePost(id, index) {
      if (confirm('Do you really want to delete it?')) {
        var app = this;
        axios
          .delete('/api/posts/' + id)
          .then(function(resp) {
            app.posts.splice(index, 1);
          })
          .catch(function(resp) {
            alert('Could not delete post');
          });
      }
    }
  }
};
</script>