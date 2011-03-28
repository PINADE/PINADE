<h1>Promotions List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Url</th>
      <th>Nom</th>
      <th>Description</th>
      <th>Filiere</th>
      <th>Id tree</th>
      <th>Branch</th>
      <th>Select branch</th>
      <th>Select</th>
      <th>Id piano day</th>
      <th>Width</th>
      <th>Height</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($promotions as $promotion): ?>
    <tr>
      <td><a href="<?php echo url_for('myedt/edit?id='.$promotion->getId()) ?>"><?php echo $promotion->getId() ?></a></td>
      <td><?php echo $promotion->getUrl() ?></td>
      <td><?php echo $promotion->getNom() ?></td>
      <td><?php echo $promotion->getDescription() ?></td>
      <td><?php echo $promotion->getFiliereId() ?></td>
      <td><?php echo $promotion->getIdTree() ?></td>
      <td><?php echo $promotion->getBranchId() ?></td>
      <td><?php echo $promotion->getSelectBranchId() ?></td>
      <td><?php echo $promotion->getSelectId() ?></td>
      <td><?php echo $promotion->getIdPianoDay() ?></td>
      <td><?php echo $promotion->getWidth() ?></td>
      <td><?php echo $promotion->getHeight() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('myedt/new') ?>">New</a>
