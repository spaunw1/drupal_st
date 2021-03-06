<?php

function nodequery2_form($form, &$form_state) {
    $options = node_type_get_names();
    $form['name'] = array(
        '#type' => 'fieldset',
        '#title' => t('Query'),
        '#collapsible' => TRUE,
        '#collapsed' => FALSE,
    );

    $form['name']['#prefix'] = '<div id="test-form-wrapper">';
    $form['name']['#suffix'] = '</div>';

    $form['name']['refresh_button'] = array(
        '#type' => 'button',
        '#value' => 'check fields',
        '#ajax' => array(
            'callback' => 'nodequery2_refresh',
            'wrapper' => 'test-form-wrapper',
        ),
    );

    $form['name']['title'] = array(
        '#type' => 'textfield',
        '#title' => t('Title matches'),
        '#default_value' => "",
        '#description' => "Please enter your query.",
        '#size' => 20,
        '#maxlength' => 20,
    );
    $form['name']['type'] = array(
        '#type' => 'radios',
        '#title' => t('тип контента'),
        '#options' => $options,
    );

    $form['name']['submit'] = array(
    '#type' => 'submit',
    '#value' => t('search'),
    '#ajax' => array(
        'callback' => 'nodequery2_ajax',
        'wrapper' => 'test-form-wrapper',
        'method' => 'replace',
        //'effect' => 'fade',
        ),
    );

    $form['name']['markup'] = array(
        '#prefix' => '<div id = "form-ajax-node-content">',
        '#suffix' => '</div>',
        '#markup' => '',
    );

    return $form;
}


function nodequery2_form_validate(&$form, &$form_state) {
    if (empty($form_state['values']['title'])) {
        form_set_error('title', t('Enter the title'));
       $errors[] = 'title';
    }
    if (empty($form_state['values']['type'])) {
        form_set_error('type', t('choose the type'));
        $errors[] = 'type';
    }

    $actions = element_children($form['name']);
    foreach ($actions as $action) {
        if (in_array($action, $errors)){
        $form_state['complete form']['name'][$action]['#attributes']['class'][] = 'nodequery2-error';
        $form_state['complete form']['name'][$action]['#title'] =  '<span class="privacy-error">заполните поле</span>';
        }
        //form_set_value($form['name']['title'],array('#attributes' => array('class' => array('nodequery2-error'))),$form_state);
       // $form['name'][$action]['#attributes']['class'][] = 'nodequery2-error';
    }
 //   $form_state['change_fields'] = TRUE;
    $form_state['rebuild'] = TRUE;
    $form_state['no_cache'] = TRUE;

    return $form;
   // drupal_add_js(array('nodequery2' => $errors), 'setting');
}

function nodequery2_refresh($form, $form_state) {
    return $form;
}
function nodequery2_ajax($form, $form_state) {

    drupal_process_form($form['#form_id'], $form, $form_state);
    //form_get_error();

    $form_state['values']['node'] = nodequery2_get_last_nodes($form_state['values']['title']);
    if (!empty($form_state['values']['title']) && !empty($form_state['values']['node'])) {
            $node = node_load_multiple(array_flip($form_state['values']['node']), array('type' => $form_state['values']['type']));
            $view = node_view_multiple($node);
            $form['markup']['#markup'] = drupal_render($view);
    }
    return $form;
}

