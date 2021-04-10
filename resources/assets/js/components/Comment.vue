<template>
  <li class="comment-wrapper animate slideInLeft ">
    <div class="profile">
      <img :src="'img/default-avatar-green-2.png'" style="width: 90%" alt="">
    </div>
    <div class="msg has-shadow">
      <div class="msg-body">
        <p class="name">{{ comment.user.name }} <span class="date">{{ posted_at }}</span></p>
        <p class="content">{{ comment.content }}</p>
        <button type="button" class="button is-medium has-shadow has-text-white" style="background-color: #47b784" v-on:click="is_replied = true">
          Reply
        </button>
        <form @keyup.enter="postComment" v-if="is_replied">
            <input type="hidden" v-model="comment_reply.parent_id">
            <div class="field has-margin-top">
                <div class="field has-margin-top">
                    <label class="label">Name</label>
                    <div class="control">
                        <input type="text" placeholder="Enter Name" class="input is-medium" v-model="comment_reply.name" required="" />
                    </div>
                </div>
                <div class="field has-margin-top">
                    <label class="label">Comment</label>
                    <div class="control">
                        <textarea style="height: 100px;" name="comment" class="input is-medium" autocomplete="true" v-model="comment_reply.content" placeholder="Enter Comment" required=""></textarea>
                    </div>
                </div>
                <div class="control has-margin-top">
                    <button style="background-color: #47b784;" :class="{'is-loading': submit}" class="button has-shadow is-medium has-text-white" :disabled="!isValid" @click.prevent="postComment" type="submit">Submit</button>
                </div>
            </div>
        </form>
      </div>
      <!-- <div class="container">
        <ul class="comment-list">
            <CommentReply :key="replied_comment.id" v-for="replied_comment in comment.replies" :comment="replied_comment"></CommentReply>
        </ul>
      </div> -->
    </div>
  </li>
</template>

<script>

  import CommentReply from "./CommentReply";

  export default {
    name: "Comment",
    props: ['comment'],
    components: { CommentReply },
    data: function(){
      return {
        is_replied: false,
        submit: false,
        comment_reply: {
            content: "",
            name: "",
            parent_id: this.comment.id
        },
      }
    },
    computed: {
      posted_at() {
        return moment(this.comment.created_at).format('MMMM Do YYYY')
      },
      isValid() {
          return this.comment_reply.content !== "" && this.comment_reply.name !== "";
      },
    },
    methods: {
        postComment() {
            this.submit = true;
            this.$store
                .dispatch("ADD_COMMENT", this.comment_reply)
                .then((response) => {
                    this.submit = false;
                    this.is_replied = false;
                    this.comment_reply.content = '';
                    this.comment_reply.name = '';

                    if (response.data === 1) console.log("success");
                })
                .catch((err) => {
                    this.submit = false;
                });
        },
    },
  }
</script>

<style lang="scss" scoped>
  .comment-wrapper {
    list-style: none;
    text-align: left;
    overflow: hidden;
    margin-bottom: 2em;
    padding: .4em;

    .profile {
      width: 80px;
      float: left;
    }

    .msg-body {
      padding: .8em;
      color: #666;
      line-height: 1.5;
    }

    .msg {
      width: 86%;
      float: left;
      background-color: #fff;
      border-radius: 0 5px 5px 5px;
      position: relative;
      &::after {
        content: " ";
        position: absolute;
        left: -13px;
        top: 0;
        border: 14px solid transparent;
        border-top-color: #fff;
      }
    }

    .date {
      float: right;
    }
    .name {
      margin: 0;
      color: #999;
      font-weight: 700;
      font-size: .8em;
    }

    p:last-child {
      margin-top: .6em;
      margin-bottom: 0;
    }

  }

</style>

<style scoped>
    .comment-list {
        padding: 1em 0;
        margin-bottom: 15px;
    }
</style>

<style scoped>
    .has-margin-top {
        margin-top: 15px;
    }
</style>