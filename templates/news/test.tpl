<style>
.BlockMetroMenuCell, .BlockMetroMenuMargin {
  height: 120px;
  display: inline-block;
  vertical-align: top; }

.BlockMetroMenuCell {
  transform: rotateY(90deg);
  transform-style: preserve-3d;
  transition: transform 0.7s ease 0.4s; 

  transition: width 0.4s ease-in-out 0s;
  visibility: hidden;
  overflow: hidden;
  width: 0px; }

.BlockMetroMenuMargin {
  transition: width 0.5s ease-in-out 0s;
  width: 150px; }

.BlockMetroMenu {
  perspective: 1000;
  white-space: nowrap;
  width: 707px;
  margin: 10px;
  overflow: hidden; }

.StandartForMetroBlock2, .NormalBlock2, .BigMetroBlock2 {
  white-space: normal;
  display: inline-block;
  vertical-align: top;
  cursor: pointer;
  margin: 10px 0 0 10px;
  padding: 5px;
  border-width: 1px;
  border-style: solid;
  word-wrap: break-word !important;
  text-shadow: 0 0 1px #000;
  color: #fff; }

.NormalBlock2:hover, .BigMetroBlock2:hover {
  box-shadow: 0 0 3px #fff;
  border-color: rgba(0, 200, 200, 1); }

.NormalBlock2 {
  font-size: 23px;
  height: 120px;
  max-width: 108px; }

.BigMetroBlock2 {
  font-size: 30px;
  height: 120px;
  max-width: 238px; }

</style>


<script>
window.onload = function(){
    setTimeout(function () {ShowMenuFull ();}, 500);
}

function ShowBlock (element, sNumber, margin, phase)
{
    if (margin)
    {
        setTimeout(function ()
        {
            element.style.width = '500px';
        }, ((sNumber * phase) / 20));

        setTimeout(function ()
        {
            element.style.width = '0px';
        }, (sNumber * phase * 20));
    }
    else
    {
        setTimeout(function ()
        {
            element.style.width = '100%';
            element.style.visibility = 'visible';
            element.style.transform = 'rotateY(360deg)';
        }, (sNumber * 70 + (phase*40)));
    }
}

function ShowMenuFull()
{
    var BlockMetroMenu     = document.getElementsByClassName("BlockMetroMenu");
    var BlockMetroMenuLine = BlockMetroMenu[0].getElementsByClassName("BlockMetroMenuLine");
    
    var BlockMetroMenuLineCount = BlockMetroMenuLine.length - 1;
    
    
    var BlockMetroMenuLineCnt = 0;
    var BlockMetroMenuCellCnt = 0;

    
    for (var i = BlockMetroMenuLineCount; i >= 0; i--)
    {
        var BlockMetroMenuMargin    = BlockMetroMenuLine[i].getElementsByClassName("BlockMetroMenuMargin");
        var BlockMetroMenuCell      = BlockMetroMenuLine[i].getElementsByClassName("BlockMetroMenuCell");

        BlockMetroMenuLineCnt++;

        ShowBlock(BlockMetroMenuMargin[0], BlockMetroMenuLineCount, true, BlockMetroMenuLineCnt);

        var BlockMetroMenuCellCount = BlockMetroMenuCell.length - 1;
        
        for (var _i = BlockMetroMenuCellCount; _i >= 0; _i--)
        {
            BlockMetroMenuCellCnt++;
            ShowBlock(BlockMetroMenuCell[_i], BlockMetroMenuCellCnt, false, BlockMetroMenuLineCnt);
        }

        BlockMetroMenuCellCnt = 0;
    }
}
</script>

<div class="BlockMetroMenu">
 <div class="BlockMetroMenuLine"><div class="BlockMetroMenuMargin"></div><div id="DopMenu" class="BigMetroBlock2 BlockMetroMenuCell"><z id="FPDPB">Дополнительное меню</z></div><div id="Docs" class="NormalBlock2 BlockMetroMenuCell"><z id="FPDPN">Докумен- ты</z></div><div id="Search" class="NormalBlock2 BlockMetroMenuCell"><z id="FPDPN">Поиск</z></div><div id="Search" class="NormalBlock2 BlockMetroMenuCell"><z id="FPDPN">Поиск</z></div></div>
 <div class="BlockMetroMenuLine"><div class="BlockMetroMenuMargin"></div><div id="DopElRes" class="BigMetroBlock2 BlockMetroMenuCell"><z id="FPDPB">Дополнительные электронные ресурсы</z></div><div id="Announce" class="NormalBlock2 BlockMetroMenuCell"><z id="FPDPN">Объявле- ния</z></div><div id="PhotoGallery" class="NormalBlock2 BlockMetroMenuCell"><z id="FPDPN">Фотога- лерея</z></div><div id="Search" class="NormalBlock2 BlockMetroMenuCell"><z id="FPDPN">Поиск</z></div></div>
 <div class="BlockMetroMenuLine"><div class="BlockMetroMenuMargin"></div><div id="DopMenu" class="BigMetroBlock2 BlockMetroMenuCell"><z id="FPDPB">Дополнительное меню</z></div><div id="Docs" class="NormalBlock2 BlockMetroMenuCell"><z id="FPDPN">Докумен- ты</z></div><div id="Search" class="NormalBlock2 BlockMetroMenuCell"><z id="FPDPN">Поиск</z></div><div id="Search" class="NormalBlock2 BlockMetroMenuCell"><z id="FPDPN">Поиск</z></div></div>
 <div class="BlockMetroMenuLine"><div class="BlockMetroMenuMargin"></div><div id="DopElRes" class="BigMetroBlock2 BlockMetroMenuCell"><z id="FPDPB">Дополнительные электронные ресурсы</z></div><div id="Announce" class="NormalBlock2 BlockMetroMenuCell"><z id="FPDPN">Объявле- ния</z></div><div id="PhotoGallery" class="NormalBlock2 BlockMetroMenuCell"><z id="FPDPN">Фотога- лерея</z></div><div id="Search" class="NormalBlock2 BlockMetroMenuCell"><z id="FPDPN">Поиск</z></div></div>
 <div class="BlockMetroMenuLine"><div class="BlockMetroMenuMargin"></div><div id="DopElRes" class="BigMetroBlock2 BlockMetroMenuCell"><z id="FPDPB">Дополнительные электронные ресурсы</z></div><div id="Announce" class="NormalBlock2 BlockMetroMenuCell"><z id="FPDPN">Объявле- ния</z></div><div id="PhotoGallery" class="NormalBlock2 BlockMetroMenuCell"><z id="FPDPN">Фотога- лерея</z></div><div id="Search" class="NormalBlock2 BlockMetroMenuCell"><z id="FPDPN">Поиск</z></div></div>

</div>
