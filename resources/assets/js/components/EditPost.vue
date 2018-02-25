<template>
    <div>
        <div class="alert alert-success" v-if="saved">
            <strong>Success!</strong> Your post has been saved successfully.
        </div>

        <div class="well well-sm" id="post-form">
            <form class="form-horizontal" method="post" @submit.prevent="onSubmit">
                <fieldset>
                    <legend class="text-center">Create the post</legend>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="title">Title</label>
                        <div class="col-md-9" :class="{'has-error': errors.title}">
                            <input id="title"
                                   v-model="post.title"
                                   type="text"
                                   placeholder="Title"
                                   class="form-control">
                            <span v-if="errors.title" class="help-block text-danger">{{ errors.title[0] }}</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="content">Content</label>
                        <div class="col-md-9" :class="{'has-error': errors.content}">
                                    <textarea class="form-control"
                                              id="content"
                                              v-model="post.content"
                                              placeholder="Please enter your content here..."
                                              rows="5"></textarea>
                            <span v-if="errors.content" class="help-block text-danger">{{ errors.content[0] }}</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="author">Author</label>
                        <div class="col-md-9" :class="{'has-error': errors.author}">
                            <input id="author"
                                   v-model="post.author"
                                   type="text"
                                   placeholder="Author"
                                   class="form-control">
                            <span v-if="errors.author" class="help-block text-danger">{{ errors.author[0] }}</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12 text-right">
                            <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</template>

<script>
export default {
  mounted() {
    let app = this;
    let id = app.$route.params.id;
    app.postId = id;
    axios.get(this.endpoint + id).then(({ data }) => {
      this.post = data.data;
    });
  },
  data() {
    return {
      errors: [],
      saved: false,
      endpoint: 'api/posts/',
      post: {
        title: null,
        content: null,
        author: null
      }
    };
  },

  methods: {
    onSubmit() {
      this.saved = false;
      let app = this;
      let id = app.$route.params.id;
      axios
        .put(this.endpoint + id, this.post)
        .then(({ data }) => this.setSuccessMessage())
        .catch(({ response }) => this.setErrors(response));
    },

    setErrors(response) {
      this.errors = response.data.errors;
    },

    setSuccessMessage() {
      this.saved = true;
    }
  }
};
</script>