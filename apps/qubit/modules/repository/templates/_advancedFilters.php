<form method="get">

  <?php foreach ($hiddenFields as $name => $value) { ?>
    <input type="hidden" name="<?php echo $name; ?>" value="<?php echo $value; ?>"/>
  <?php } ?>

  <div class="advanced-repository-filters-content">

    <div class="row-fluid">
      <div class="span4">
        <label for="thematicAreas"><?php echo __('Thematic area:'); ?></label>
        <select name="thematicAreas" id="thematicAreas">
          <option></option>
          <?php foreach ($thematicAreas as $r) { ?>
            <option value="<?php echo $r->getId(); ?>"<?php if ($r->getId() == $sf_request->getParameter('thematicAreas')) { ?>
              <?php echo selected; ?>
            <?php } ?>>
              <?php echo get_search_i18n($r->getData(), 'name', ['cultureFallback' => true]); ?>
            </option>
          <?php } ?>
        </select>
      </div>

      <div class="span4">
        <label for="types"><?php echo __('Archive type:'); ?></label>
        <select name="types" id="types">
          <option></option>
          <?php foreach ($repositoryTypes as $r) { ?>
            <option value="<?php echo $r->getId(); ?>"<?php if ($r->getId() == $sf_request->getParameter('types')) { ?>
              <?php echo selected; ?>
            <?php } ?>>
              <?php echo get_search_i18n($r->getData(), 'name', ['cultureFallback' => true]); ?>
            </option>
          <?php } ?>
        </select>
      </div>

      <div class="span4">
        <label for="regions"><?php echo __('Region:'); ?></label>
        <select name="regions" id="regions">
          <option></option>
          <?php $regions = []; ?>
          <?php foreach ($repositories as $r) { ?>
            <?php $region = get_search_i18n($r->getData(), 'region', ['allowEmpty' => true, 'culture' => $sf_user->getCulture(), 'cultureFallback' => false]); ?>

            <?php if ($region && !in_array($region, $regions)) { ?>
              <?php $regions[] = $region; ?>
              <option value="<?php echo $region; ?>"<?php if ($region == $sf_request->getParameter('regions')) { ?>
                <?php echo selected; ?>
              <?php } ?>>             
                <?php echo $region; ?>
              </option>
            <?php } ?>
          <?php } ?>
        </select>
      </div>
    </div>

  </div>

  <section class="actions">
    <input type="submit" class="c-btn c-btn-submit" value="<?php echo __('Set filters'); ?>">
  </section>

</form>
