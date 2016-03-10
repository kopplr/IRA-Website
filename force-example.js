var w = 400,
    h = 400,
    nodeCircles,
    linkLines,
    root;

var scaleFactor = 1;
var translation = [0,0];

/*** Configure Force Layout ***/
var force = d3.layout.force()
    .on("tick", tick)
    .charge(function (d) {
        return d._children ? -d.size / 100 : -50;
    })
    .linkDistance(function (d) {
        return d.target._children ? 80 : 30;
    })
    .friction(0.90) //slow down by 10% each tick
    .size([w, h]);


/*** Configure zoom behaviour ***/
var zoomer = d3.behavior.zoom()
                .scaleExtent([0.1,10])
        //allow 10 times zoom in or out
                .on("zoom", zoom);
        //define the event handler function
function zoom() {
    console.log("zoom", d3.event.translate, d3.event.scale);
    scaleFactor = d3.event.scale;
    translation = d3.event.translate;
    tick(); //update positions
}

/*** Configure drag behaviour ***/
var drag = d3.behavior.drag()
        .origin(function(d) { return d; }) //center of circle
        .on("dragstart", dragstarted)
        .on("drag", dragged)
        .on("dragend", dragended);

function dragstarted(d){
	 	console.log("dragstarted");
    d3.event.sourceEvent.stopPropagation();
    d3.select(this).classed("dragging", true);
    force.stop(); //stop ticks while dragging
}
function dragged(d){
    if (d.fixed) return; //root is fixed

    //get mouse coordinates relative to the visualization
    //coordinate system:
    var mouse = d3.mouse(vis.node());
    d.x = (mouse[0] - translation[0])/scaleFactor;
    d.y = (mouse[1] - translation[1])/scaleFactor;
    tick();//re-position this node and any links
}
function dragended(d){
    d3.select(this).classed("dragging", false);
    force.resume();
}

/** Initialize SVG ***/
var graph = d3.select(".intgraph").append("svg:svg")
        .attr("width", w)
        .attr("height", h)
    .append("g")
        .attr("class", "graph")
        .call(zoomer); //Attach zoom behaviour.

// Add a transparent background rectangle to catch
// mouse events for the zoom behaviour.
// Note that the rectangle must be inside the element (graph)
// which has the zoom behaviour attached, but must be *outside*
// the group that is going to be transformed.
var rect = graph.append("rect")
    .attr("width", w)
    .attr("height", h)
    //.style("fill", "none")
        //make transparent (vs black if commented-out)
    .style("pointer-events", "all");
        //respond to mouse, even when transparent

var vis = graph.append("svg:g")
            .attr("class", "plotting-area");
//create a group that will hold all the content to be zoomed
/*** Initialize and position node and link elements ***/
function update() {
    var nodes = flatten(root),
        links = d3.layout.tree().links(nodes);

    // Restart the force layout.
    force.nodes(nodes)
        .links(links)
        .start();

    // Update the links…
    linkLines = vis.selectAll("line.link")
        .data(links, function (d) {
            return d.target.id;
        });

    // Enter any new links.
    linkLines.enter().insert("svg:line", ".node")
        .attr("class", "link");

    // Exit any old links.
    linkLines.exit().remove();

    // Update the nodes
    nodeCircles = vis.selectAll("circle.node")
        .data(nodes, function (d) {
        return d.id;
    })
        .style("fill", color);

    // Enter any new nodes.
    nodeCircles.enter().append("svg:circle")
        .attr("class", "node")
        .attr("r", function (d) {
        return d.children ? 4.5 : Math.sqrt(d.size) / 10;
    })
        .style("fill", color)
        .call(drag); //attach drag behaviour

    // Exit any old nodes.
    nodeCircles.exit().remove();

    // Set initial positions of nodes and links
    tick();
}

function color(d) {
    return  d===root? "#ffffff"
    //distinguish root since it can't be dragged
        : d.children ? "#c6dbef" : d.group;
}

/*** Set the position of the elements based on data ***/
function tick() {
    linkLines.attr("x1", function (d) {
            return translation[0] + scaleFactor*d.source.x;
        })
        .attr("y1", function (d) {
            return translation[1] + scaleFactor*d.source.y;
        })
        .attr("x2", function (d) {
            return translation[0] + scaleFactor*d.target.x;
        })
        .attr("y2", function (d) {
            return translation[1] + scaleFactor*d.target.y;
        });

    nodeCircles.attr("cx", function (d) {
            return translation[0] + scaleFactor*d.x;
        })
        .attr("cy", function (d) {
            return translation[1] + scaleFactor*d.y;
        });
}


/*** Data functions ***/

//take a json object, fix the root in the center of the
//display, and call update to position everything else:
function readfile(json) {
    root = json;
    root.fixed = true;
    root.x = w / 2;
    root.y = h / 2;
    update();
};

// Returns all nodes under the root as an array.
function flatten(root) {
    var nodes = [],
        i = 0;

    function recurse(node) {
        if (node.children) node.size = node.children.reduce(function (p, v) {
            return p + recurse(v);
        }, 0);
        if (!node.id) node.id = ++i;
        nodes.push(node);
        return node.size;
    }

    root.size = recurse(root);
    return nodes;
}
