$(function(){
	$.ajax({
		url: 'PHP/comments.php',
	})
	.success(function(xml){
		var comments = $(xml).find('comment');
		$(comments).each(function(){
			var authorName = $('author', this).text();
			var authorId = $('author', this).attr('id');
			var authorLink = $('</a>').href('user.php?id='+authorId).text(authorName);
			var author = $('</p>').append(authorLink).addClass('commentAuthor');
			var content = $('</p>').text($('content', this).text()).addClass('commentContent');
			var date = $('</h5>').text($('date', this).text()).addClass('commentDate');
			var div = $('</div>').append(author, content, date).addClass('commentBox')
		})
	})
})