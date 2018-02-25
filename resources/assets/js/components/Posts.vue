<template>
    <div>
        <div class="form-group">
            <router-link :to="{name: 'createPost'}" class="btn btn-success">Create new post</router-link>
        </div>
        <div class="card mb-3" v-for='(post, index) in posts' :key='index'>
            <img class="card-img-top" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22734%22%20height%3D%22180%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20734%20180%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_161c6997bf7%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A37pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_161c6997bf7%22%3E%3Crect%20width%3D%22734%22%20height%3D%22180%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22272.9921875%22%20y%3D%22106.8046875%22%3E734x180%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" alt="Card image cap">
            <div class="card-body">
                <h3 class="card-title"><router-link :to="{name: 'showPost', params: {id: post.id}}" class="nav-link">{{ post.title }}</router-link></h3>
                <p class="card-text">{{ post.content }}</p>
                <p class="card-text"><small class="text-muted">Last updated {{ post.date }}</small></p>
            </div>
         </div>
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
      endpoint: 'api/posts?page=',
      post: {}
    };
  },

  created() {
    this.fetch();
  },

  methods: {
    fetch(page = 1) {
      axios.get(this.endpoint + page).then(({ data }) => {
        this.posts = data.data;
        this.pageCount = data.meta.last_page;
      });
    },

    show(id) {
      axios.get(this.endpoint + '/' + id).then(({ data }) => {
        this.post = data.data;
        this.pageCount = data.meta.last_page;
      });
    },

    removePost(id) {
      this.posts = _.remove(this.posts, function(post) {
        return post.id !== id;
      });
    }
  }
};
</script>