<?= $this->assign('title', __("Manage Attachments")); ?>

<div class="content-wrapper interface-blur">
	<div class="row">

		<div class="col-md-12">
			<?= $this->Flash->render(); ?>
		</div>

		<div class="col-md-12 heading">
			<h1 class="page-header">
				<i class="fa fa-file-archive-o"></i> <?= __("Manage Attachments");?>
			</h1>
			<ol class="breadcrumb">
				<li>
					<?= $this->Html->link(__("{0} Dashboard", '<i class="fa fa-dashboard"></i>'), ['controller' => 'admin',
					'action' => 'home', 'prefix' => 'admin'], ['escape' => false]) ?>
				</li>
				<li class="active">
					<i class="fa fa-file-archive-o"></i> <?= __("Manage Attachments");?>
				</li>
			</ol>
		</div>

		<div class="col-md-12">
			<div class="panel panel-default">

				<div class="panel-heading">
					<?= __("Manage Attachments"); ?>
				</div>

				<div class="panel-body">

					<div class="panel-body-header">
						<?= $this->Html->link(__("{0} New Attachment", '<i class="fa fa-plus"></i>'),
						['controller' => 'attachments', 'action' => 'add', 'prefix' => 'admin'],
						['class' => 'btn btn-primary', 'escape' => false]) ?>
					</div>

					<?php if($attachments->toArray()): ?>
						<table class="table table-striped">
							<thead>
								<tr>
									<th><?= __('#Id') ?></th>
									<th><?= __('Author') ?></th>
									<th><?= __('Article') ?></th>
									<th><?= __('Name') ?></th>
									<th><?= __('Size') ?></th>
									<th><?= __('Extension') ?></th>
									<th><?= __('Download') ?></th>
									<th><?= __('Created') ?></th>
									<th><?= __('Action') ?></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($attachments as $attachment):?>
									<tr>
										<td>
											#<?= $attachment->id ?>
										</td>
										<td>
											<?= $this->Html->link($attachment->user->full_name, ['_name' => 'users-edit',
											'slug' => $attachment->user->slug]) ?>
										</td>
										<td>
											<?= $this->Html->link(
												$this->Text->truncate(
													$attachment->blog_article->title,
													35,
													[
														'ellipsis' => '...',
														'exact' => false
													]
												),
												[
													'_name' => 'blog-article',
													'prefix' => false,
													'slug' => $attachment->blog_article->slug,
													'?' => ['page' => $attachment->blog_article->last_page]
												],
												[
													'target' => '_blank',
													'data-toggle' => 'tooltip',
													'title' => __("View this Article"),
												]
											) ?>
										</td>
										<td>
											<?= h($attachment->name) ?>
										</td>
										<td>
											<?= $this->Number->toReadableSize($attachment->size) ?>
										</td>
										<td>
											<?= h($attachment->extension) ?>
										</td>
										<td>
											<?= $this->Number->format($attachment->download, ['precision' => 2, 'locale' => 'en_US']) ?>
										</td>
										<td>
											<?= $attachment->created->format('d-m-Y') ?>
										</td>
										<td>
											<?= $this->Html->link(
												'<i class="fa fa-download"></i>',
												[
													'_name' => 'attachment-download',
													'type' => 'blog',
													'id' => $attachment->id
												],
												[
													'class' => 'btn btn-sm',
													'data-toggle' => 'tooltip',
													'title' => __("Download this attachment"),
													'escape' => false
												]
											)?>
											<?= $this->Html->link(
												'<i class="fa fa-edit"></i>',
												[
													'_name' => 'attachments-edit',
													'id' => $attachment->id
												],
												[
													'class' => 'btn btn-sm btn-primary',
													'data-toggle' => 'tooltip',
													'title' => __("Edit this attachment"),
													'escape' => false
												]
											)?>
											<?= $this->Html->link(
												'<i class="fa fa-remove"></i>',
												[
													'_name' => 'attachments-delete',
													'id' => $attachment->id
												],
												[
													'class' => 'btn btn-sm btn-danger',
													'data-toggle' => 'tooltip',
													'title' => __("Delete this attachment"),
													'escape' => false
												]
											)?>
										</td>
									</tr>
								<?php endforeach;?>
							</tbody>
						</table>

						<div class="pagination-centered">
							<ul class="pagination">
								<?php if ($this->Paginator->hasPrev()): ?>
									<?= $this->Paginator->prev('«'); ?>
								<?php endif; ?>
								<?= $this->Paginator->numbers(['modulus' => 5]); ?>
								<?php if ($this->Paginator->hasNext()): ?>
									<?= $this->Paginator->next('»'); ?>
								<?php endif; ?>
							</ul>
						</div>
					<?php else: ?>
						<div class="infobox infobox-info">
							<h4>
								<?= __("No attachments was found."); ?>
							</h4>
						</div>
					<?php endif; ?>
				</div>

			</div>
		</div>


	</div>
</div>