<?php echo $header; ?>
<?php echo $column_left; ?>
<style>

.node {
  cursor: pointer;
}

.node circle {
  fill: #fff;
  stroke: steelblue;
  stroke-width: 1.5px;
}

.node text {
  font: 10px sans-serif;
}

.link {
  fill: none;
  stroke: #ccc;
  stroke-width: 1.5px;
}
.bitree{margin-left: 12px;
    padding: 0px;
    overflow-x: scroll;
    
   
}
svg:not(:root) {
     overflow: auto; 
         margin-left: -30px;
}
.bitree::-webkit-scrollbar-track
{
  -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
  background-color: #F5F5F5;
}

.bitree::-webkit-scrollbar
{
  width: 10px;
  background-color: #F5F5F5;
}

.bitree::-webkit-scrollbar-thumb
{
  background-color: #0ae;
  
  background-image: -webkit-gradient(linear, 0 0, 0 100%,
                     color-stop(.5, rgba(255, 255, 255, .2)),
             color-stop(.5, transparent), to(transparent));
}
span.cir {
    border: 5px solid #00f;
    width: 10px;
    border-radius: 50px;
    height: 10px;
    display: inline-block;
}
.cir.lv0{
  border-color: black;
}
.cir.lv1{
  border-color: blue;
}
.cir.lv2{
  border-color: red;
}
.cir.lv3{
  border-color: darkturquoise;
}
.cir.lv4{
  border-color: chartreuse;
}
.cir.lv5{
  border-color: yellow;
}
.cir.lv6{
  border-color: cyan;
}
.bitree {
    margin-left: 12px;
    padding: 0px;
    overflow-x: scroll;
}
</style>
<div class="main-content">
<!-- Start .content -->
  <div class="content" style="">
     <div class="row">
        <!-- .row start -->
        <div class="col-md-12">
           <!-- col-md-12 start here -->
           <div class="panel panel-default" id="dash_0">
              <!-- Start .panel -->
              <div class="panel-heading">
                 <h4 class="panel-title"><i class="fa fa-align-justify"></i>SƠ DỒ TUYẾN DƯỚI</h4>
              </div>
              <div class="panel-body form-horizontal group-border stripped">
                 <div class="form-group">
                    <div class="col-lg-12 col-md-12">
                      <div class="input-group input-icon file-upload">
                       <div class="" style="width: 1039px">
                          <div class="panel-body tab-pane bitree active">
                            <div id="tab-tree">
                            </div>
                          </div>
                        
                      </div>    
                      </div>
                 </div>
              </div>
           </div>
        </div>
     </div>
  </div>
</div>
<script>

var margin = {top: 20, right: 120, bottom: 20, left: 120},
    width = 3000 - margin.right - margin.left,
    height = 700 - margin.top - margin.bottom;

var i = 0,
    duration = 750,
    root;

var tree = d3.layout.tree()
    .size([height, width]);

var diagonal = d3.svg.diagonal()
    .projection(function(d) { return [d.y, d.x]; });

var svg = d3.select("#tab-tree").append("svg")
    .attr("width", width + margin.right + margin.left)
    .attr("height", height + margin.top + margin.bottom)
  .append("g")
    .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

d3.json("<?php echo $trees; ?>", function(error, flare) {
  if (error) throw error;

  root = flare;
  root.x0 = height / 2;
  root.y0 = 0;

  function collapse(d) {
    if (d.children) {
      d._children = d.children;
      d._children.forEach(collapse);
      d.children = null;
    }
  }

  root.children.forEach(collapse);
  update(root);
});

d3.select(self.frameElement).style("height", "800px");

function update(source) {

  // Compute the new tree layout.
  var nodes = tree.nodes(root).reverse(),
      links = tree.links(nodes);

  // Normalize for fixed-depth.
  nodes.forEach(function(d) { d.y = d.depth * 180; });

  // Update the nodes…
  var node = svg.selectAll("g.node")
      .data(nodes, function(d) { return d.id || (d.id = ++i); });

  // Enter any new nodes at the parent's previous position.
  var nodeEnter = node.enter().append("g")
      .attr("class", "node")
      .attr("transform", function(d) { return "translate(" + source.y0 + "," + source.x0 + ")"; })
      .on("click", click);

  nodeEnter.append("circle")
      .attr("r", function(d) { return d.value; })
      .style("stroke", function(d) { return d.type; })
      .style("fill", function(d) { return d._children ? d.type : "#fff"; });

  nodeEnter.append("text")
      .attr("x", function(d) { return d.children || d._children ? -10 : 10; })
      .attr("dy", ".35em")
      .attr("text-anchor", function(d) { return d.children || d._children ? "end" : "start"; })
      .text(function(d) { return d.text; })
      .style("fill-opacity", 1e-6);

  // Transition nodes to their new position.
  var nodeUpdate = node.transition()
      .duration(duration)
      .attr("transform", function(d) { return "translate(" + d.y + "," + d.x + ")"; });

  nodeUpdate.select("circle")
      .attr("r", 6, function(d) { return d.value; }) 
      .style("fill", function(d) { return d._children ? "d.type" : "#fff"; });

  nodeUpdate.select("text")
      .style("fill-opacity", 1);

  // Transition exiting nodes to the parent's new position.
  var nodeExit = node.exit().transition()
      .duration(duration)
      .attr("transform", function(d) { return "translate(" + source.y + "," + source.x + ")"; })
      .remove();

  nodeExit.select("circle")
      .attr("r", 1e-6);

  nodeExit.select("text")
      .style("fill-opacity", 1e-6);

  // Update the links…
  var link = svg.selectAll("path.link")
      .data(links, function(d) { return d.target.id; });

  // Enter any new links at the parent's previous position.
  link.enter().insert("path", "g")
      .attr("class", "link")
      .attr("d", function(d) {
        var o = {x: source.x0, y: source.y0};
        return diagonal({source: o, target: o});
      });

  // Transition links to their new position.
  link.transition()
      .duration(duration)
      .attr("d", diagonal);

  // Transition exiting nodes to the parent's new position.
  link.exit().transition()
      .duration(duration)
      .attr("d", function(d) {
        var o = {x: source.x, y: source.y};
        return diagonal({source: o, target: o});
      })
      .remove();

  // Stash the old positions for transition.
  nodes.forEach(function(d) {
    d.x0 = d.x;
    d.y0 = d.y;
  });
}

// Toggle children on click.
function click(d) {
  if (d.children) {
    d._children = d.children;

    d.children = null;
  } else {
    d.children = d._children;
    d._children = null;
  }
  update(d);
}

</script>


<?php echo $footer; ?>