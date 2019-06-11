<?php $__env->startSection('content'); ?>
    <style>
        .torrent-graph {
            width: 100%;
            height: 100%;
        }
        #svgWrap svg .node .text {
            fill: rgba(225,250,250,0.6);
            text-anchor: middle;
            pointer-events: none;
        }
    </style>
    <div class="content">
        <main class="main-content">
            <div class="wallet-inner ">
                <div class="wallet-inner__header">
                    <h2>Decentralized Network</h2>
                    <br>
                            <button style="position:inherit;"  type="button" onclick="window.location.reload();" class="btn btn--blue">
                                <i class="fa fa-refresh"></i> Refresh
                            </button>
                    <br>
                    <br>
                    <br>

                    <div class="container">
                        <div class="row">
                            <div class="col-lg">
                                <div class="card">
                                    <div class="card-body">
                                        <div id="svgWrap" class="col-lg" style="background-color: #2a3749">
                                            <div class="torrent-graph"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </main>

    </div>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"> </script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.4.0/clipboard.min.js"></script>
    <script>

        $(document).ready(function()
        {
            setInterval(function() {
                $.getJSON('https://supbank.fr/networkMap.json', function(data) {
                    data.forEach(loop(0));
                });
            }, 2000);

        });
        let graph = new window.P2PGraph('.torrent-graph');

        function loop(level) {

            return function (a) {

                if(!graph.hasPeer(a.host)){

                    graph.add({
                        id: a.host,
                        me: a.master,
                        name: a.host
                    });

                }

                if(Array.isArray(a.children)) {
                    a.children.forEach(function(entry) {
                        if(!(graph.hasPeer(entry.host)))
                        {
                            graph.add({
                                id: entry.host,
                                me: entry.master,
                                name: entry.host
                            });
                        }

                    });
                }


                if(Array.isArray(a.children)) {
                    a.children.forEach(function(entry) {
                        if(!(graph.hasLink(a.host, entry.host)))
                        {
                            setTimeout(graph.connect(a.host, entry.host), 1000);
                        }
                    });
                }
                Array.isArray(a.children) && a.children.forEach(loop(level + 1));
            }

        }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>