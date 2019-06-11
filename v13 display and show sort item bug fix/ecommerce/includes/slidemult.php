<script>
$(document).ready(function () {
    var itemsMainDiv = ('.MultiCarousel');
    var itemsDiv = ('.MultiCarousel-inner');
    var itemWidth = "";

    $('.leftLst, .rightLst').click(function () {
        var condition = $(this).hasClass("leftLst");
        if (condition)
            click(0, this);
        else
            click(1, this)
    });

    ResCarouselSize();




    $(window).resize(function () {
        ResCarouselSize();
    });

    //this function define the size of the items
    function ResCarouselSize() {
        var incno = 0;
        var dataItems = ("data-items");
        var itemClass = ('.item');
        var id = 0;
        var btnParentSb = '';
        var itemsSplit = '';
        var sampwidth = $(itemsMainDiv).width();
        var bodyWidth = $('body').width();
        $(itemsDiv).each(function () {
            id = id + 1;
            var itemNumbers = $(this).find(itemClass).length;
            btnParentSb = $(this).parent().attr(dataItems);
            itemsSplit = btnParentSb.split(',');
            $(this).parent().attr("id", "MultiCarousel" + id);


            if (bodyWidth >= 1200) {
                incno = itemsSplit[3];
                itemWidth = sampwidth / incno;
            }
            else if (bodyWidth >= 992) {
                incno = itemsSplit[2];
                itemWidth = sampwidth / incno;
            }
            else if (bodyWidth >= 768) {
                incno = itemsSplit[1];
                itemWidth = sampwidth / incno;
            }
            else {
                incno = itemsSplit[0];
                itemWidth = sampwidth / incno;
            }
            $(this).css({ 'transform': 'translateX(0px)', 'width': itemWidth * itemNumbers });
            $(this).find(itemClass).each(function () {
                $(this).outerWidth(itemWidth);
            });

            $(".leftLst").addClass("over");
            $(".rightLst").removeClass("over");

        });
    }


    //this function used to move the items
    function ResCarousel(e, el, s) {
        var leftBtn = ('.leftLst');
        var rightBtn = ('.rightLst');
        var translateXval = '';
        var divStyle = $(el + ' ' + itemsDiv).css('transform');
        var values = divStyle.match(/-?[\d\.]+/g);
        var xds = Math.abs(values[4]);
        if (e == 0) {
            translateXval = parseInt(xds) - parseInt(itemWidth * s);
            $(el + ' ' + rightBtn).removeClass("over");

            if (translateXval <= itemWidth / 2) {
                translateXval = 0;
                $(el + ' ' + leftBtn).addClass("over");
            }
        }
        else if (e == 1) {
            var itemsCondition = $(el).find(itemsDiv).width() - $(el).width();
            translateXval = parseInt(xds) + parseInt(itemWidth * s);
            $(el + ' ' + leftBtn).removeClass("over");

            if (translateXval >= itemsCondition - itemWidth / 2) {
                translateXval = itemsCondition;
                $(el + ' ' + rightBtn).addClass("over");
            }
        }
        $(el + ' ' + itemsDiv).css('transform', 'translateX(' + -translateXval + 'px)');
    }

    //It is used to get some elements from btn
    function click(ell, ee) {
        var Parent = "#" + $(ee).parent().attr("id");
        var slide = $(Parent).attr("data-slide");
        ResCarousel(ell, Parent, slide);
    }

});
</script>
<style>
.MultiCarousel { float: left; overflow: hidden; padding: 15px; width: 100%; position:relative; }
.MultiCarousel .MultiCarousel-inner { transition: 1s ease all; float: left; }
.MultiCarousel .MultiCarousel-inner .item { float: left;}
.MultiCarousel .MultiCarousel-inner .item > div { text-align: center; padding:10px; margin:0px; background:white; color:black;}
.MultiCarousel .leftLst, .MultiCarousel .rightLst { position:absolute; border-radius:50%;top:calc(50% - 20px); }
.MultiCarousel .leftLst { left:0; }
.MultiCarousel .rightLst { right:0; }

.MultiCarousel .leftLst.over, .MultiCarousel .rightLst.over { pointer-events: auto; background-position: top; cursor: pointer;}
.container {
  position: relative;
  width: 100%;
}

/* Make the image responsive */
.container img {
  width: 100%;
  height: 200px;
}
img {
    max-width: 100%;
    display: block;
}

.thumbnail {


    -webkit-transform: translate(-50%,-50%); /* Safari and Chrome */
    -moz-transform: translate(-50%,-50%); /* Firefox */
    -ms-transform: translate(-50%,-50%); /* IE 9 */
    -o-transform: translate(-50%,-50%); /* Opera */
    transform: translate(-50%,-50%);
}

</style>
<?php
//
$transQ = $db->query("SELECT * FROM cart WHERE paid = 1 ORDER BY id DESC LIMIT 10");
$results=array();
while($row = mysqli_fetch_assoc($transQ)){
  $results[] =$row;
}
$row_count = $transQ->num_rows;
$used_ids = array();
for($i=0;$i<$row_count;$i++){
  $json_items = $results[$i]['items'];
  $items = json_decode($json_items,true);
  foreach ($items as $item) {
    if(!in_array($item['id'],$used_ids)){
      $used_ids[] = $item['id'];
    }
  }
} ?>
<div class="container bar-top">
	<div class="row" >
      <h3 class="text-center">⇩Trending Products⇩</h3>
		<div class="MultiCarousel" data-items="2,3,4,4" data-slide="2" id="MultiCarousel"  data-interval="1000">
              <div class="MultiCarousel-inner">
              <?php foreach ($used_ids as $id):
                $productQ = $db->query("SELECT * FROM products WHERE id='{$id}'");
                $productT = mysqli_fetch_assoc($productQ);
                $Tphotos = explode(',',$productT['image']); ?>
                <div class="item " >
                    <div class="pad15 container animation polaroid text-center ">
                     <img onclick="detailsmodal(<?= $productT['id'] ?>)" src="<?=(isset($Tphotos[0])?$Tphotos[0]:'');?>"><p></p>
                     <p><strong><?=(isset($productT['title'])?$productT['title']:'');?></strong></p>
                  </div>
                  </div>
              <?php endforeach; ?>
              </div>
            <button class="btn btn-danger leftLst"><<</button>
            <button class="btn btn-danger rightLst">>></button>
        </div>
	</div>
</div>