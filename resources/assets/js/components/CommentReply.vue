<template>
  <li class="comment-wrapper animate slideInLeft ">
    <div class="profile">
      <img :src="'img/default-avatar-green-2.png'" style="width: 90%" alt="">
    </div>
    <div class="msg has-shadow">
      <div class="msg-body">
        <p class="name">{{ comment.user.name }} <span class="date">{{ posted_at }}</span></p>
        <p class="content">{{ comment.content }}</p>
      </div>
    </div>
  </li>
</template>

<script>
  export default {
    name: "CommentReply",
    props: ['comment'],
    computed: {
      posted_at() {
        return moment(this.comment.created_at).format('MMMM Do YYYY')
      }
    }
  }
</script>