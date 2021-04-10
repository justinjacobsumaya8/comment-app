<template>
  <li class="comment-wrapper animate slideInLeft d-flex mt-2">
    <div class="profile flex-0-0-12">
      <img :src="'img/default-avatar-green-2.png'" style="width: 90%" alt="">
    </div>
    <div class="msg">
      <div class="msg-body">
        <p class="name d-flex justify-content-between">{{ comment.user.name }} <span class="date">{{ posted_at }}</span></p>
        <p class="content">{{ comment.content }}</p>
      </div>
    </div>
  </li>
</template>

<script>
  export default {
    name: "CommentReplyThird",
    props: ['comment'],
    data: function(){
      return {
        is_replied: false,
        submit: false,
        comment_reply: {
            content: '',
            name: '',
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
                  if (response.data === 1)
                  {
                      this.submit = false;
                      this.is_replied = false;
                      this.comment_reply.content = '';
                      this.comment_reply.name = '';

                      bus.$emit('refresh', response.data);
                  }
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
    .d-flex {
        display: flex;
    }
    .flex-0-0-12 {
      flex: 0 0 12%;
    }

    .mt-2 {
      margin-top: 2em;
    }

    .justify-content-between {
      justify-content: space-between;
    }
</style>