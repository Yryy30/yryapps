<?= $this->extend("layout/app") ?>

<?= $this->section("content") ?>
<header class="page-header">
    <h2>Users</h2>

    <div class="right-wrapper pull-right">
        <ol class="breadcrumbs">
            <li>
                <a href="<?= base_url('/admin') ?>">
                    <i class="fa fa-home"></i>
                </a>
            </li>
            <li><span>Users</span></li>
        </ol>

        <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
    </div>
</header>

<div class="row">
    <?php
        if(session()->get("success")){
        ?>
            <h3><?= session()->get("success") ?></h3>
        <?php
        }
        if(session()->get("error")){
        ?>
        <h3><?= session()->get("error") ?></h3>
        <?php
        }
    ?>
</div>

<div class="row">
    <section class="panel">
    
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped mb-none">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    	foreach ($users as $value) {
                    ?>
                        <tr>
                            <td hidden=""><?php echo $value['id']; ?></td>
                            <td>
                            <img src="s.jpg" class="img-circle">
                            </td>
                            <td><?php echo $value['name'] ?></td>
                            <td><?php echo $value['email'] ?></td>
                            <td><?php echo $value['role'] ?></td>
                            <td>a</td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

<?= $this->endSection() ?>