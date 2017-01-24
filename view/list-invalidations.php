<?php
/**
 * Created by PhpStorm.
 * User: janneaalto
 * Date: 24/01/2017
 * Time: 0.38
 */

$invalidations = $this->list_invalidations();
?>
    <div class="wrap" id="c3-dashboard">
        <table class="wp-list-table widefat plugins">
            <thead>
            <tr>
                <th colspan='3'>
                    <h2><?php echo __('CloudFront Invalidation Logs', 'c3-cloudfront-clear-cache'); ?></h2>
                </th>
            </tr>
            <tr>
                <th><b><?php echo __('Invalidation Start Time (UTC)', 'c3-cloudfront-clear-cache'); ?></b></th>
                <th><b><?php echo __('Invalidation Status', 'c3-cloudfront-clear-cache'); ?></b></th>
                <th><b><?php echo __('Invalidation Id', 'c3-cloudfront-clear-cache'); ?></b></th>
            </tr>
            </thead>
            <tbody>
                <?php if($invalidations){ ?>

                    <?php foreach ($invalidations as $invalidation) {
                        $time = date_i18n('y/n/j G:i:s', strtotime($invalidation['CreateTime'])); ?>
                        <tr>
                            <td><?php echo $time; ?></td>
                            <td><?php echo $invalidation['Status']; ?></td>
                            <td><?php echo $invalidation['Id']; ?></td>
                        </tr>
                    <?php } ?>

                <?php }else{ ?>

                    <tr>
                        <td colspan="3">
                            <?php echo __('There is no invalidations', 'c3-cloudfront-clear-cache'); ?>
                        </td>
                    </tr>

                <?php } ?>
            </tbody>

        </table>
    </div>





