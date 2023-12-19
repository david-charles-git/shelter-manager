<?php
function get_shelter_manager_options()
{
  $options = array(
    'api_uri' => '',
    'api_image_uri' => '',
    'api_base_uri' => SHELTER_MANAGER_PLUGIN_API_URI_BASE,
    'api_form_name' => carbon_get_theme_option('shelter_manager_form_name'),
    'api_account' => carbon_get_theme_option('shelter_manager_api_account'),
    'api_username' => carbon_get_theme_option('shelter_manager_api_username'),
    'api_password' => carbon_get_theme_option('shelter_manager_api_password'),
    'animal_page_slug' => carbon_get_theme_option('shelter_manager_animal_page_slug'),
  );
  $options['api_uri'] = $options['api_base_uri'] . 'account=' . $options['api_account'] . '&username=' . $options['api_username'] . '&password=' . $options['api_password'];
  $options['api_image_uri'] = $options['api_base_uri'] . 'account=' . $options['api_account'] . '&method=animal_image&animalid=';

  return $options;
}

function get_animal_adoption_form_groups()
{
  $adoption_form_groups = [
    '0' => [
      [
        'introduction_copy' => '',
        'type' => 'text',
        'value' => '',
        'name' => 'firstname_1884',
        'id' => 'firstname',
        'placeholder' => 'First Name',
        'label' => 'First Name',
        'options' => [],
        'inputs' => [],
        'conditional' => [
          'type' => 'none',
        ],
        'required' => true,
        'error_message' => 'Please enter a first name'
      ],
      [
        'introduction_copy' => '',
        'type' => 'text',
        'value' => '',
        'name' => 'lastname_1885',
        'id' => 'lastname',
        'placeholder' => 'Last Name',
        'label' => 'Last Name',
        'options' => [],
        'inputs' => [],
        'conditional' => [
          'type' => 'none',
        ],
        'required' => true,
        'error_message' => 'Please enter a last name'
      ],
      [
        'introduction_copy' => '',
        'type' => 'text',
        'value' => '',
        'name' => 'address_1886',
        'id' => 'address',
        'placeholder' => 'Address',
        'label' => 'Address',
        'options' => [],
        'inputs' => [],
        'conditional' => [
          'type' => 'none',
        ],
        'required' => true,
        'error_message' => 'Please enter an address'
      ],
      [
        'introduction_copy' => '',
        'type' => 'text',
        'value' => '',
        'name' => 'town_1918',
        'id' => 'town',
        'placeholder' => 'Town',
        'label' => 'Town',
        'options' => [],
        'inputs' => [],
        'conditional' => [
          'type' => 'none',
        ],
        'required' => true,
        'error_message' => 'Please enter an town'
      ],
      [
        'introduction_copy' => '',
        'type' => 'postcode',
        'value' => '',
        'name' => 'postcode_1887',
        'id' => 'postcode',
        'placeholder' => 'Post code',
        'label' => 'Post code',
        'options' => [],
        'inputs' => [],
        'conditional' => [
          'type' => 'none',
        ],
        'required' => true,
        'error_message' => 'Please enter a postcode'
      ],
      [
        'introduction_copy' => '',
        'type' => 'phonenumber',
        'value' => '',
        'name' => 'hometelephone_1888',
        'id' => 'hometelephone',
        'placeholder' => 'Phone number (home)',
        'label' => 'Phone number (home)',
        'options' => [],
        'inputs' => [],
        'conditional' => [
          'type' => 'none',
        ],
        'required' => true,
        'error_message' => 'Please enter a home phone number'
      ],
      [
        'introduction_copy' => '',
        'type' => 'phonenumber',
        'value' => '',
        'name' => 'mobiletelephone_1889',
        'id' => 'mobiletelephone',
        'placeholder' => 'Phone number (mobile)',
        'label' => 'Phone number (mobile)',
        'options' => [],
        'inputs' => [],
        'conditional' => [
          'type' => 'none',
        ],
        'required' => true,
        'error_message' => 'Please enter a mobile phone number'
      ],
      [
        'introduction_copy' => '',
        'type' => 'text',
        'value' => '',
        'name' => 'emailaddress_1890',
        'id' => 'emailaddress',
        'placeholder' => 'Email',
        'label' => 'Email',
        'options' => [],
        'inputs' => [],
        'conditional' => [
          'type' => 'none',
        ],
        'required' => true,
        'error_message' => 'Please enter an email address'
      ],
      [
        'introduction_copy' => '',
        'type' => 'date',
        'value' => '',
        'name' => 'dateofbirth_1891',
        'id' => 'dateofbirth',
        'placeholder' => 'Date of birth',
        'label' => 'Date of birth',
        'options' => [],
        'inputs' => [],
        'conditional' => [
          'type' => 'none',
        ],
        'required' => true,
        'error_message' => 'Please enter a date of birth'
      ],
      [
        'introduction_copy' => '',
        'type' => 'text',
        'value' => '',
        'name' => 'propertytype_1892',
        'id' => 'propertytype',
        'placeholder' => 'Property Type (e.g. Detached, Semi, flat, boat etc)',
        'label' => 'Property type',
        'options' => [],
        'inputs' => [],
        'conditional' => [
          'type' => 'none',
        ],
        'required' => true,
        'error_message' => 'Please enter a property type'
      ],
      [
        'introduction_copy' => '',
        'type' => 'checkbox',
        'value' => 'rented',
        'name' => 'propertyownership_1893',
        'id' => 'propertyownership',
        'placeholder' => 'Property ownership',
        'label' => 'My property is:',
        'options' => [
          [
            'value' => 'owned',
            'label' => 'Owned'
          ],
          [
            'value' => 'rented',
            'label' => 'Rented'
          ],
        ],
        'inputs' => [],
        'conditional' => [
          'type' => 'none',
        ],
        'required' => true,
        'error_message' => 'Please select a property ownership'
      ],
      [
        'introduction_copy' => '',
        'type' => 'textarea',
        'value' => '',
        'name' => 'garden_1894',
        'id' => 'garden',
        'placeholder' => 'Tell us about your garden',
        'label' => 'Tell us about your garden (size, fencing height, private/shared, no garden etc)',
        'options' => [],
        'inputs' => [],
        'conditional' => [
          'type' => 'none',
        ],
        'required' => true,
        'error_message' => 'Please enter your garden details'
      ],
      [
        'introduction_copy' => '',
        'type' => 'textarea',
        'value' => '',
        'name' => 'homeoccupants_1898',
        'id' => 'homeoccupants',
        'placeholder' => 'Who lives in your home?',
        'label' => 'Who lives in your home? (please tell us names, ages, relationship to you and occupation of all adults)',
        'options' => [],
        'inputs' => [],
        'conditional' => [
          'type' => 'none',
        ],
        'required' => true,
        'error_message' => 'Please enter who lives in your home'
      ],
      [
        'introduction_copy' => '',
        'type' => 'textarea',
        'value' => '',
        'name' => 'adoptionreason_1900',
        'id' => 'adoptionreason',
        'placeholder' => 'Why do you want a dog? ',
        'label' => 'Why do you want a dog? ',
        'options' => [],
        'inputs' => [],
        'conditional' => [
          'type' => 'none',
        ],
        'required' => true,
        'error_message' => 'Please enter a reason for wanting a dog'
      ],
      [
        'introduction_copy' => '',
        'type' => 'textarea',
        'value' => '',
        'name' => 'animalspenddaylocation_1899',
        'id' => 'animalspenddaylocation',
        'placeholder' => 'Where will the dog spend most of its day?',
        'label' => 'Where will the dog spend most of its day? (include where it will stay and who it will be with)',
        'options' => [],
        'inputs' => [],
        'conditional' => [
          'type' => 'none',
        ],
        'required' => true,
        'error_message' => 'Please enter where will the dog spend most of its day'
      ],
      [
        'introduction_copy' => '',
        'type' => 'textarea',
        'value' => '',
        'name' => 'animalsleepnight_1902',
        'id' => 'animalsleepnight',
        'placeholder' => 'Where will the dog sleep at night?',
        'label' => 'Where will the dog sleep at night?',
        'options' => [],
        'inputs' => [],
        'conditional' => [
          'type' => 'none',
        ],
        'required' => true,
        'error_message' => 'Please enter a where will the dog sleep at night'
      ],
      [
        'introduction_copy' => '',
        'type' => 'textarea',
        'value' => '',
        'name' => 'animalactivities_1903',
        'id' => 'animalactivities',
        'placeholder' => 'What exercise/activities would you do with the dog?',
        'label' => 'What exercise/activities would you do with the dog? (walking, running, training, agility, scent work etc)',
        'options' => [],
        'inputs' => [],
        'conditional' => [
          'type' => 'none',
        ],
        'required' => true,
        'error_message' => 'What exercise/activities would you do with the dog'
      ],
      [
        'introduction_copy' => '',
        'type' => 'textarea',
        'value' => '',
        'name' => 'currentpets_1907',
        'id' => 'currentpets',
        'placeholder' => 'What pets do you currently have in your home?',
        'label' => 'What pets do you currently have in your home? (please include type, breed, age and whether they are neutered or not) ',
        'options' => [],
        'inputs' => [],
        'conditional' => [
          'type' => 'none',
        ],
        'required' => true,
        'error_message' => 'Please enter what pets you currently have in your home'
      ],
      [
        'introduction_copy' => '',
        'type' => 'textarea',
        'value' => '',
        'name' => 'previousdogs_1909',
        'id' => 'previousdogs',
        'placeholder' => 'If you don’t have any current dogs, have you owned dogs before?',
        'label' => 'If you don’t have any current dogs, have you owned dogs before?  If so tell us more (please include, breed, age and what happened to them)',
        'options' => [],
        'inputs' => [],
        'conditional' => [
          'type' => 'none',
        ],
        'required' => true,
        'error_message' => 'Please enter if you have owned dogs before'
      ],
      [
        'introduction_copy' => '',
        'type' => 'checkbox',
        'value' => 'yes',
        'name' => 'animalinsurance_1910',
        'id' => 'animalinsurance',
        'placeholder' => 'Will you arrange insurance for a dog you adopt?',
        'label' => 'Will you arrange insurance for a dog you adopt?',
        'options' => [
          [
            'value' => 'yes',
            'label' => 'Yes'
          ],
          [
            'value' => 'no',
            'label' => 'No'
          ],
        ],
        'inputs' => [],
        'conditional' => [
          'type' => 'handler',
          'conditions' => '[{"id":"noanimalinsurancereson", "condition":"equal_to", "value":"no"}]'
        ],
        'required' => true,
        'error_message' => 'Please select an insurance option'
      ],
      //here
      [
        'introduction_copy' => '',
        'type' => 'textarea',
        'value' => '',
        'name' => 'noanimalinsurancereson_1917',
        'id' => 'noanimalinsurancereson',
        'placeholder' => 'Why will you not arrange insurance for a dog you adopt?',
        'label' => 'Why will you not arrange insurance for a dog you adopt?',
        'options' => [],
        'inputs' => [],
        'conditional' => [
          'type' => 'target',
        ],
        'required' => false,
        'error_message' => 'Please enter why you will not arrange insurance for a dog you adopt?'
      ],
      [
        'introduction_copy' => '',
        'type' => 'checkbox',
        'value' => 'no',
        'name' => 'financialstability_1911',
        'id' => 'financialstability',
        'placeholder' => 'Are you financially able to afford insurance, vet care, grooming costs etc for a dog?',
        'label' => 'Are you financially able to afford insurance, vet care, grooming costs etc for a dog?',
        'options' => [
          [
            'value' => 'yes',
            'label' => 'Yes'
          ],
          [
            'value' => 'no',
            'label' => 'No'
          ],
        ],
        'inputs' => [],
        'conditional' => [
          'type' => 'none',
        ],
        'required' => true,
        'error_message' => 'Please select a financial stability option'
      ],
      [
        'introduction_copy' => '',
        'type' => 'textarea',
        'value' => '',
        'name' => 'animalchewitemsreaction_1912',
        'id' => 'animalchewitemsreaction',
        'placeholder' => 'What would you do if a dog were to chew items in your home?',
        'label' => 'What would you do if a dog were to chew items in your home? (carpet, furniture, shoes etc)?',
        'options' => [],
        'inputs' => [],
        'conditional' => [
          'type' => 'none',
        ],
        'required' => true,
        'error_message' => 'Please enter a reaction for if a dog were to chew items in your home'
      ],
      [
        'introduction_copy' => '',
        'type' => 'checkbox',
        'value' => 'no',
        'name' => 'animaltraininghousetoilet_1904',
        'id' => 'animaltraininghousetoilet',
        'placeholder' => 'Are you willing to house/toilet train a dog?',
        'label' => 'Are you willing to house/toilet train a dog?',
        'options' => [
          [
            'value' => 'yes',
            'label' => 'Yes'
          ],
          [
            'value' => 'no',
            'label' => 'No'
          ],
        ],
        'inputs' => [],
        'conditional' => [
          'type' => 'none',
        ],
        'required' => true,
        'error_message' => 'Please select a house / toilet training option'
      ],
      [
        'introduction_copy' => '',
        'type' => 'checkbox',
        'value' => 'no',
        'name' => 'animaltrainingclasses_1905',
        'id' => 'animaltrainingclasses',
        'placeholder' => 'Will you attend dog training classes?',
        'label' => 'Will you attend dog training classes?',
        'options' => [
          [
            'value' => 'yes',
            'label' => 'Yes'
          ],
          [
            'value' => 'no',
            'label' => 'No'
          ],
        ],
        'inputs' => [],
        'conditional' => [
          'type' => 'none',
        ],
        'required' => true,
        'error_message' => 'Please select a training classes option'
      ],
      [
        'introduction_copy' => '',
        'type' => 'checkbox',
        'value' => 'no',
        'name' => 'animalyearscommitment_1906',
        'id' => 'animalyearscommitment',
        'placeholder' => 'Are you prepared to make the 10-18 year commitment to care for a dog?',
        'label' => 'Are you prepared to make the 10-18 year commitment to care for a dog?',
        'options' => [
          [
            'value' => 'yes',
            'label' => 'Yes'
          ],
          [
            'value' => 'no',
            'label' => 'No'
          ],
        ],
        'inputs' => [],
        'conditional' => [
          'type' => 'none',
        ],
        'required' => true,
        'error_message' => 'Please select a commitment option'
      ],
      [
        'introduction_copy' => '',
        'type' => 'textarea',
        'value' => '',
        'name' => 'additionalinformation_1913',
        'id' => 'additionalinformation',
        'placeholder' => 'Additional information...',
        'label' => 'Is there anything else you would like to tell us to support your application?',
        'options' => [],
        'inputs' => [],
        'conditional' => [
          'type' => 'none',
        ],
        'required' => false,
        'error_message' => 'Please enter additional information'
      ],
      [
        'introduction_copy' => 'I understand that by signing below I am declaring that I have read and understood the terms and conditions and privacy notice and agree to the conditions if I proceed. I certify by signing below that I am at least 21 years of age and the information I have given in my Adoption Application Form is true. I recognise that any misrepresentation of facts may result in my losing the privilege of adopting a dog, and I understand that Saving Souls Animal Rescue has the right to deny my application. This completed online form is deemed as a signed agreement. Once we approve your application and confirm it to you, then it is deemed as both parties have fully accepted the terms and conditions under England and Wales Law.',
        'type' => 'true-false',
        'value' => 'false',
        'name' => 'termsandconditions_1914',
        'id' => 'termsandconditions',
        'placeholder' => '',
        'label' => 'This is a digital signature and I have read and agree to the <a href="">Terms and Conditions</a>',
        'options' => [],
        'inputs' => [],
        'conditional' => [
          'type' => 'none',
        ],
        'required' => true,
        'error_message' => 'Please agree to the terms and conditions'
      ],
    ]
  ];

  return $adoption_form_groups;
}
