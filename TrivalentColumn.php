<?php

/**
 * @package   yii2-grid
 * @author    Eduardo Silva <eduardo@open-ecommerce.org> based in BooleanColumn
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2015
 * @version   1.0.0
 */

namespace kartik\grid;

use Yii;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * A TrivalentColumn to convert 0-1-2 values as user friendly indicators
 * with an automated drop down filter for the Grid widget [[\kartik\widgets\GridView]]
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.0
 */
class TrivalentColumn extends DataColumn {

    /**
     * @var string the horizontal alignment of each column. Should be one of
     * 'left', 'right', or 'center'. Defaults to `center`.
     */
    public $hAlign = 'center';

    /**
     * @var string the width of each column (matches the CSS width property).
     * Defaults to `90px`.
     * @see http://www.w3schools.com/cssref/pr_dim_width.asp
     */
    public $width = '90px';

    /**
     * @var string|array in which format should the value of each data model be displayed
     * Defaults to `raw`.
     * [[\yii\base\Formatter::format()]] or [[\yii\i18n\Formatter::format()]] is used.
     */
    public $format = 'raw';

    /**
     * @var boolean|string|Closure the page summary that is displayed above the footer.
     * Defaults to false.
     */
    public $pageSummary = false;

    /**
     * @var integer value for the first value. Defaults to `0`.
     */
    public $oneValue = 0;

    /**
     * @var integer value for the first value. Defaults to `1`.
     */
    public $twoValue = 1;

    /**
     * @var integer value for the first value. Defaults to `2`.
     */
    public $threeValue = 2;    
    
    
    /**
     * @var string label for the true value. Defaults to `0`.
     */
    public $oneLabel;

    /**
     * @var string label for the false value. Defaults to `1`.
     */
    public $twoLabel;

    /**
     * @var string label for the false value. Defaults to `2`.
     */
    public $threeLabel;

    /**
     * @var string icon/indicator for the true value. If this is not set, it will use the value from `trueLabel`.
     * If GridView `bootstrap` property is set to true - it will default to [[GridView::ICON_ONE]]
     * `<span class="glyphicon glyphicon-remove text-danger"></span>`
     */
    public $oneIcon;

    /**
     * @var string icon/indicator for the false value. If this is null, it will use the value from `falseLabel`.
     * If GridView `bootstrap` property is set to true - it will default to [[GridView::ICON_TWO]]
     * `<span class="glyphicon glyphicon-pause text-danger"></span>`
     */
    public $twoIcon;

    /**
     * @var string icon/indicator for the false value. If this is null, it will use the value from `falseLabel`.
     * If GridView `bootstrap` property is set to true - it will default to [[GridView::ICON_THREE]]
     * `<span class="glyphicon glyphicon-ok text-success"></span>`
     */
    public $threeIcon;

    /**
     * @var integer whether to show null value as a one icon.
     */
    public $showNullAsOne = false;

    /**
     * @inheritdoc
     */
    public function init() {
        if (empty($this->oneLabel)) {
            $this->oneLabel = Yii::t('kvgrid', 'Not Started');
        }
        if (empty($this->twoLabel)) {
            $this->twoLabel = Yii::t('kvgrid', 'In Progress');
        }
        if (empty($this->threeLabel)) {
            $this->threeLabel = Yii::t('kvgrid', 'finished');
        }

        $this->filter = [$this->oneValue => $this->oneLabel, $this->twoValue => $this->twoLabel, $this->threeValue => $this->threeLabel];

        if (empty($this->oneIcon)) {
            $this->oneIcon = ($this->grid->bootstrap) ? GridView::ICON_TRIVALENT_ONE : $this->oneIcon;
        }

        if (empty($this->twoIcon)) {
            $this->twoIcon = ($this->grid->bootstrap) ? GridView::ICON_TRIVALENT_TWO : $this->twoIcon;
        }

        if (empty($this->threeIcon)) {
            $this->threeIcon = ($this->grid->bootstrap) ? GridView::ICON_TRIVALENT_THREE : $this->threeIcon;
        }

        parent::init();
    }

    /**
     * @inheritdoc
     */
    public function getDataCellValue($model, $key, $index) {
        $value = parent::getDataCellValue($model, $key, $index);

        switch ($value) {
            case "0":
                $response = $this->oneIcon;
                break;
            case "1":
                $response = $this->twoIcon;
                break;
            case "2":
                $response = $this->threeIcon;
                break;
            default:
                $response = $this->oneIcon;
        }

        return $response;
    }

}
