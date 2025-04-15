<?php
namespace Drupal\myblock\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;

/**
 * Provides a 'Dynamic Content Block' with configurable title, description, and image.
 *
 * @Block(
 *   id = "dynamic_content_block",
 *   admin_label = @Translation("Dynamic Content Block"),
 *   category = @Translation("Dynamic Category"),
 * )
 */
class DynamicContentBlock extends BlockBase {

    /**
     * {@inheritdoc}
     * Block Configuration Form - Creates Title, Description, and Image fields in UI.
     */
    public function blockForm($form, FormStateInterface $form_state) {
        $config = $this->getConfiguration();

        $form['block_title'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Block Title'),
            '#default_value' => $config['block_title'] ?? '',
            '#description' => $this->t('Enter the title for this block.'),
        ];

        $form['block_description'] = [
            '#type' => 'text_format',
            '#title' => $this->t('Block Description'),
            '#default_value' => $config['block_description']['value'] ?? '',
            '#format' => $config['block_description']['format'] ?? 'full_html',
            '#description' => $this->t('Enter the description for this block.'),
        ];

        $form['block_image'] = [
            '#type' => 'managed_file',
            '#title' => $this->t('Block Image'),
            '#upload_location' => 'public://block_images/',
            '#default_value' => isset($config['block_image']) ? [$config['block_image']] : [],
            '#description' => $this->t('Upload an image for this block.'),
            '#upload_validators' => [
                'file_validate_extensions' => ['png jpg jpeg webp jfif'],
                'file_validate_size' => [2097152], // 2MB limit
            ],
        ];

        return $form;
    }

    /**
     * {@inheritdoc}
     * Save the configuration values.
     */
    public function blockSubmit($form, FormStateInterface $form_state) {
        $this->setConfigurationValue('block_title', $form_state->getValue('block_title'));
        $this->setConfigurationValue('block_description', $form_state->getValue('block_description'));

        // Save the image file as permanent and store its ID
        $image_fid = $form_state->getValue('block_image')[0] ?? NULL;
        if ($image_fid) {
            $file = File::load($image_fid);
            if ($file) {
                $file->setPermanent();
                $file->save();
                // Ensure the file is published and available
                \Drupal::service('file.usage')->add($file, 'myblock', 'myblock', $file->id());
                \Drupal::logger('files')->notice($file->id());
                $this->setConfigurationValue('block_image', $image_fid);
            }
        }
    }

    /**
     * {@inheritdoc}
     * Build the block's output.
     */
    public function build() {
        $config = $this->getConfiguration();

        $image_url = '';
        if (!empty($config['block_image'])) {
            $file = File::load($config['block_image']);
            if ($file) {
                $image_uri = $file->getFileUri();

                // Check if file exists in the filesystem
                if (\Drupal::service('file_system')->realpath($image_uri)) {
                    $image_url = \Drupal::service('file_url_generator')->generateAbsoluteString($image_uri);
                } else {
                    \Drupal::messenger()->addMessage($this->t('The image file is missing or not accessible.'), 'error');
                }
            }
        }

        return [
            '#theme' => 'dynamic_content_block',
            '#title' => $config['block_title'] ?? 'Default Title',
            '#description' => [
                '#type' => 'processed_text',
                '#text' => $config['block_description']['value'] ?? 'Default Description',
                '#format' => $config['block_description']['format'] ?? 'full_html',
            ],
            '#image_url' => $image_url,
            '#attached' => [
                'library' => [
                    'myblock/new_block_styles',
                ],
            ],
        ];
    }
}
?>