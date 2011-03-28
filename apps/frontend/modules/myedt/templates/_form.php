<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('myedt/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('myedt/index') ?>">Back to list</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'myedt/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['url']->renderLabel() ?></th>
        <td>
          <?php echo $form['url']->renderError() ?>
          <?php echo $form['url'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['nom']->renderLabel() ?></th>
        <td>
          <?php echo $form['nom']->renderError() ?>
          <?php echo $form['nom'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['description']->renderLabel() ?></th>
        <td>
          <?php echo $form['description']->renderError() ?>
          <?php echo $form['description'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['filiere_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['filiere_id']->renderError() ?>
          <?php echo $form['filiere_id'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['id_tree']->renderLabel() ?></th>
        <td>
          <?php echo $form['id_tree']->renderError() ?>
          <?php echo $form['id_tree'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['branch_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['branch_id']->renderError() ?>
          <?php echo $form['branch_id'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['select_branch_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['select_branch_id']->renderError() ?>
          <?php echo $form['select_branch_id'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['select_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['select_id']->renderError() ?>
          <?php echo $form['select_id'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['id_piano_day']->renderLabel() ?></th>
        <td>
          <?php echo $form['id_piano_day']->renderError() ?>
          <?php echo $form['id_piano_day'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['width']->renderLabel() ?></th>
        <td>
          <?php echo $form['width']->renderError() ?>
          <?php echo $form['width'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['height']->renderLabel() ?></th>
        <td>
          <?php echo $form['height']->renderError() ?>
          <?php echo $form['height'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
