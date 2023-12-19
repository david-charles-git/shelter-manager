# Shelter Manager Plugin

*updated: 19-12-2023*

## Introduction

This documentation is a work in progress and will be updated as the plugin continues to be developed.

The Shelter Manager Plugin is a wordpress plugin that allows the user to read and write certain data to their Shelter Manager database. The plugin uses the Shelter Manager API and therefore is restricted in its functionality. That being said, the plugin has been built with expansion in mind and can be easily extended to include more features that manipulate the data to create custom responses, feeds and forms.
Here is a link to the Shelter Manager API documentation: <https://sheltermanager.com/repo/asm3_help/index.html> [UPDATED: 17-11-2023]

I have split the documentation into two sections. The User Guide and the Developer Guide. The User Guide is for the end user and contains information on how to use the plugin. The Developer Guide is for developers and contains information on how the plugin works, how to extend it etc.

## User Guide

### User installation

**(The installation process assumes you have a wordpress site set up and running and that you have a copy of the shelter-manager.zip file)**

1. Log in to your wordpress admin dashboard.
2. Click on Plugins in the left hand menu.
3. Click on Add New at the top of the page.
4. Click on Upload Plugin at the top of the page.
5. Click on Choose File and select the shelter-manager.zip file.
6. Click on Install Now.
7. Click on Activate Plugin.

### Shelter Manager Plugin Settings

1. Log in to your wordpress admin dashboard.
2. Click on Shelter Manager in the left hand menu.

This page contains some documentation on the plugin (needs to be updated) and the following settings:

- **Shelter Manager API Account ID**: This is the account id for the Shelter Manager API. This is required.
- **Shelter Manager API Username**: This is the username for the Shelter Manager API. This is required.
- **Shelter Manager API Password**: This is the password for the Shelter Manager API. This is required.
- **Shelter Manager Animal Page Slug**: This is the slug of the page that the [**shelter_manager_animals_page**] can be found on. This url is used to host and generate the individual animal pages using the api. This is required.

### Shortcodes

#### shelter_manager_auto_generated_adoptable_feed

This shortcode will generate a list of adoptable animals that is the default shelter manager feed.

``` txt
[shelter_manager_auto_generated_adoptable_feed]
```

#### shelter_manager_animal_feed

This shortcode will generate a feed of animals based on the parameters passed to it.

``` txt
[shelter_manager_animal_feed]
```

- **class**: This is the class of the div that will wrap the feed. This is optional and defaults to ''.
- **type**: This is the type of feed that will be generated. This is optional and defaults to 'shelter'. Available options are 'adoptable', 'found', 'held', 'lost', 'shelter', 'recently_adopted', 'recently_changed'.
- **title**: This is the title of the feed. This is has not yet been been added to the front end in terms of layout and style. This is optional and defaults to ''.
- **limit**: This is the number of animals that will be displayed. This is optional and defaults to '12'. To display all animals, pass '-1'.
- **offset**: This is the number of animals that will be skipped. This is optional and defaults to '0'.

#### shelter_manager_animal_details

This shortcode will generate a widget containing the api data for a given animal, dependent on the parameters.

``` txt
[shelter_manager_animal_details]
```

- **class**: This is the class of the div that will wrap the feed. This is optional and defaults to ''.
- **type**: This is the type of widget that will be generated. This is optional and defaults to 'shelter'. Available options are 'adoptable', 'found', 'held', 'lost', 'shelter', 'recently_adopted', 'recently_changed'.
- **animal_id**: This is the id of the animal that will be displayed. This is optional and defaults to 'all'. If all is passed, nothing will be displayed.

#### shelter_manager_animal_adoption_form

This shortcode will generate a form that will allow a user to submit an adoption request for a given animal.

``` txt
[shelter_manager_animal_adoption_form]
```

- **class**: This is the class of the div that will wrap the feed. This is optional and defaults to ''.
- **animal_id**: This is the id of the animal that will be displayed. This is optional and defaults to 'all'. If all is passed, the form will not specify an animal.
- **success_message**: This is the message that will be displayed when the form is successfully submitted. This is optional and defaults to 'Thank you for your submission!'.
- **error_message**: This is the message that will be displayed when the form is not successfully submitted. This is optional and defaults to 'There was an error submitting your form. Please try again.'.

#### shelter_manager_animal_page

This shortcode will generate a page that take query parameters and display the appropriate data.

``` txt
[shelter_manager_animal_page]
```

- **class**: This is the class of the div that will wrap the feed. This is optional and defaults to ''.
- **type**: This is the type of feed that will be generated. This is optional and defaults to 'shelter'. Available options are 'adoptable', 'found', 'held', 'lost', 'shelter', 'recently_adopted', 'recently_changed'.
- **animal_id**: This is the id of the animal that will be displayed. If not animal_id is passed, the page will display a list of animals based on the type parameter (uses the shortcode [shelter_manager_feed] to generate it).
- **limit**: This is the number of animals that will be displayed. This is optional and defaults to '12'. To display all animals, pass '-1'.
- **offset**: This is the number of animals that will be skipped. This is optional and defaults to '0'.
- **success_message**: This is the message that will be displayed when the form is successfully submitted. This is optional and defaults to 'Thank you for your submission!'.
- **error_message**: This is the message that will be displayed when the form is not successfully submitted. This is optional and defaults to 'There was an error submitting your form. Please try again.'.

### Query Parameters

The following query parameters can be passed to the url to change the data displayed and functionality of the plugin shortcodes.

- **sm_type**: This is the type that will be use as the type parameter in the following shortcodes: [**shelter_manager_animal_adoption_form**], [**shelter_manager_animal_details**], [**shelter_manager_animal_page**]. Available options are 'adoptable', 'found', 'held', 'lost', 'shelter', 'recently_adopted', 'recently_changed'.
- **sm_animal_id**: This is the animal_id that will be use as the animal_id parameter in the following shortcodes: [**shelter_manager_animal_adoption_form**], [**shelter_manager_animal_details**], [**shelter_manager_animal_page**].
- **sm-feed-filter-value**: This is the value that will be used to filter the feed if it exists on the page. This is currently only used in the [**shelter_manager_animal_feed**] shortcode.
- **sm-feed-filter-type**: This is the type that will be used to filter the feed if it exists on the page. This is currently only used in the [**shelter_manager_animal_feed**] shortcode.

### Functions



### Adoption Form

The adoption form is a custom form that is generated by the plugin. It is not currently possible to customize the form. The form is generated by the shortcode [shelter_manager_animal_adoption_form]. The form is submitted via ajax and the response is displayed on the page.

When the user submits the form, the following will happen:

- Creates a new adoption form post containing the data from the form. The posts can be found in the admin dashboard under SM - forms. The posts are created as a back up in case the api call fails.
- Submits the form data to the api endpoint and stores the submission in the Shelter Manager database.
-Shelter Manager will send an email to the email address that is set in the Shelter Manager form settings

## Developer Guide

### Developer installation

1. Clone the repository to your local machine from:

``` bash
git clone https://github.com/david-charles-git/shelter-manager.git
```

2. Enter the directory:

``` bash
cd shelter-manager
```

3. Install the dependencies:

``` bash
yarn install
```

### Development

Typescript is used to write the plugin. The source code can be found and **must** by added in the root of the typescript directory for the plugin to build correctly. The typescript is compiled and minified to the includes/dist directory. The plugin is compiled using a custom build script that can be found at _bash/build.sh.

Scss is used to write the styles for the plugin. The source code can be found and **must** by added in the root of the sass directory for the plugin to build correctly. The plugin is compiled to the includes/dist directory. The Scss is compiled using a custom build script that can be found at _bash/build.sh.

The plugin uses Composer to manage its dependencies. The composer.json, composer.lock, vendor directory file can be found in the root of the plugin directory. The plugin dependencies are: 

- **Carbon Fields** - This is used to create the custom fields pages, and options for the plugin.


## Shelter Manager Database example return object

``` txt
[
  'ID',
  'ANIMALTYPEID',
  'ANIMALNAME',
  'NONSHELTERANIMAL',
  'CRUELTYCASE',
  'BONDEDANIMALID',
  'BONDEDANIMAL2ID',
  'BASECOLOURID',
  'SPECIESID',
  'BREEDID',
  'BREED2ID',
  'BREEDNAME',
  'CROSSBREED',
  'COATTYPE',
  'MARKINGS',
  'SHELTERCODE',
  'SHORTCODE',
  'EXTRAIDS',
  'UNIQUECODEID',
  'YEARCODEID',
  'SMARTTAGSENTDATE',
  'ACCEPTANCENUMBER',
  'DATEOFBIRTH',
  'ESTIMATEDDOB',
  'AGEGROUP',
  'DECEASEDDATE',
  'SEX',
  'FEE',
  'IDENTICHIPPED',
  'IDENTICHIPNUMBER',
  'IDENTICHIPDATE',
  'IDENTICHIP2NUMBER',
  'IDENTICHIP2DATE',
  'TATTOO',
  'TATTOONUMBER',
  'TATTOODATE',
  'SMARTTAG',
  'SMARTTAGNUMBER',
  'SMARTTAGDATE',
  'SMARTTAGTYPE',
  'NEUTERED',
  'NEUTEREDDATE',
  'NEUTEREDBYVETID',
  'COMBITESTED',
  'COMBITESTDATE',
  'COMBITESTRESULT',
  'HEARTWORMTESTED',
  'HEARTWORMTESTDATE',
  'HEARTWORMTESTRESULT',
  'FLVRESULT',
  'DECLAWED',
  'HIDDENANIMALDETAILS',
  'ANIMALCOMMENTS',
  'POPUPWARNING',
  'OWNERSVETID',
  'CURRENTVETID',
  'OWNERID',
  'ORIGINALOWNERID',
  'BROUGHTINBYOWNERID',
  'ADOPTIONCOORDINATORID',
  'REASONFORENTRY',
  'REASONNO',
  'DATEBROUGHTIN',
  'ENTRYREASONID',
  'ASILOMARISTRANSFEREXTERNAL',
  'ASILOMARINTAKECATEGORY',
  'ASILOMAROWNERREQUESTEDEUTHANASIA',
  'ISPICKUP',
  'PICKUPLOCATIONID',
  'PICKUPADDRESS',
  'JURISDICTIONID',
  'HEALTHPROBLEMS',
  'PUTTOSLEEP',
  'PTSREASON',
  'PTSREASONID',
  'ISCOURTESY',
  'ISDOA',
  'ISTRANSFER',
  'ISGOODWITHCATS',
  'ISGOODWITHDOGS',
  'ISGOODWITHCHILDREN',
  'ISHOUSETRAINED',
  'ISNOTAVAILABLEFORADOPTION',
  'ISNOTFORREGISTRATION',
  'ISHOLD',
  'HOLDUNTILDATE',
  'ISQUARANTINE',
  'HASSPECIALNEEDS',
  'ADDITIONALFLAGS',
  'SHELTERLOCATION',
  'SHELTERLOCATIONUNIT',
  'DIEDOFFSHELTER',
  'SIZE',
  'WEIGHT',
  'RABIESTAG',
  'ARCHIVED',
  'ADOPTABLE',
  'ACTIVEMOVEMENTID',
  'ACTIVEMOVEMENTTYPE',
  'ACTIVEMOVEMENTDATE',
  'ACTIVEMOVEMENTRETURN',
  'HASACTIVERESERVE',
  'HASTRIALADOPTION',
  'HASPERMANENTFOSTER',
  'DISPLAYLOCATION',
  'MOSTRECENTENTRYDATE',
  'TIMEONSHELTER',
  'TOTALTIMEONSHELTER',
  'DAYSONSHELTER',
  'TOTALDAYSONSHELTER',
  'AGEGROUPACTIVEMOVEMENT',
  'DAILYBOARDINGCOST',
  'ANIMALAGE',
  'RECORDVERSION',
  'CREATEDBY',
  'CREATEDDATE',
  'LASTCHANGEDBY',
  'LASTCHANGEDDATE',
  'ANIMALTYPENAME',
  'BONDEDANIMAL1NAME',
  'BONDEDANIMAL1CODE',
  'BONDEDANIMAL1ARCHIVED',
  'BONDEDANIMAL1IDENTICHIPNUMBER',
  'BONDEDANIMAL2NAME',
  'BONDEDANIMAL2CODE',
  'BONDEDANIMAL2ARCHIVED',
  'BONDEDANIMAL2IDENTICHIPNUMBER',
  'BASECOLOURNAME',
  'ADOPTAPETCOLOUR',
  'SPECIESNAME',
  'PETFINDERSPECIES',
  'BREEDNAME1',
  'BREEDNAME2',
  'PETFINDERBREED',
  'PETFINDERBREED2',
  'COATTYPENAME',
  'SEXNAME',
  'SIZENAME',
  'OWNERNAME',
  'OWNERSVETNAME',
  'OWNERSVETADDRESS',
  'OWNERSVETTOWN',
  'OWNERSVETCOUNTY',
  'OWNERSVETPOSTCODE',
  'OWNERSVETWORKTELEPHONE',
  'OWNERSVETEMAILADDRESS',
  'OWNERSVETLICENCENUMBER',
  'CURRENTVETNAME',
  'CURRENTVETFORENAMES',
  'CURRENTVETSURNAME',
  'CURRENTVETADDRESS',
  'CURRENTVETTOWN',
  'CURRENTVETCOUNTY',
  'CURRENTVETPOSTCODE',
  'CURRENTVETWORKTELEPHONE',
  'CURRENTVETEMAILADDRESS',
  'CURRENTVETLICENCENUMBER',
  'NEUTERINGVETNAME',
  'NEUTERINGVETADDRESS',
  'NEUTERINGVETTOWN',
  'NEUTERINGVETCOUNTY',
  'NEUTERINGVETPOSTCODE',
  'NEUTERINGVETWORKTELEPHONE',
  'NEUTERINGVETEMAILADDRESS',
  'NEUTERINGVETLICENCENUMBER',
  'ORIGINALOWNERNAME',
  'ORIGINALOWNERTITLE',
  'ORIGINALOWNERINITIALS',
  'ORIGINALOWNERFORENAMES',
  'ORIGINALOWNERSURNAME',
  'ORIGINALOWNERADDRESS',
  'ORIGINALOWNERTOWN',
  'ORIGINALOWNERCOUNTY',
  'ORIGINALOWNERPOSTCODE',
  'ORIGINALOWNERCOUNTRY',
  'ORIGINALOWNERHOMETELEPHONE',
  'ORIGINALOWNERWORKTELEPHONE',
  'ORIGINALOWNERMOBILETELEPHONE',
  'ORIGINALOWNEREMAILADDRESS',
  'ORIGINALOWNERIDNUMBER',
  'ORIGINALOWNERLATLONG',
  'ORIGINALOWNERJURISDICTION',
  'CURRENTOWNERID',
  'CURRENTOWNERNAME',
  'CURRENTOWNERTITLE',
  'CURRENTOWNERINITIALS',
  'CURRENTOWNERFORENAMES',
  'CURRENTOWNERSURNAME',
  'CURRENTOWNERADDRESS',
  'CURRENTOWNERTOWN',
  'CURRENTOWNERCOUNTY',
  'CURRENTOWNERPOSTCODE',
  'CURRENTOWNERCOUNTRY',
  'CURRENTOWNERHOMETELEPHONE',
  'CURRENTOWNERWORKTELEPHONE',
  'CURRENTOWNERMOBILETELEPHONE',
  'CURRENTOWNEREMAILADDRESS',
  'CURRENTOWNEREMAILADDRESS2',
  'CURRENTOWNERIDNUMBER',
  'CURRENTOWNEREXCLUDEEMAIL',
  'CURRENTOWNERLATLONG',
  'CURRENTOWNERJURISDICTION',
  'BROUGHTINBYOWNERNAME',
  'BROUGHTINBYOWNERADDRESS',
  'BROUGHTINBYOWNERTOWN',
  'BROUGHTINBYOWNERCOUNTY',
  'BROUGHTINBYOWNERPOSTCODE',
  'BROUGHTINBYHOMETELEPHONE',
  'BROUGHTINBYWORKTELEPHONE',
  'BROUGHTINBYMOBILETELEPHONE',
  'BROUGHTINBYEMAILADDRESS',
  'BROUGHTINBYLATLONG',
  'BROUGHTINBYJURISDICTION',
  'RESERVEDOWNERID',
  'RESERVEDOWNERNAME',
  'RESERVEDOWNERTITLE',
  'RESERVEDOWNERINITIALS',
  'RESERVEDOWNERFORENAMES',
  'RESERVEDOWNERSURNAME',
  'RESERVEDOWNERADDRESS',
  'RESERVEDOWNERTOWN',
  'RESERVEDOWNERCOUNTY',
  'RESERVEDOWNERPOSTCODE',
  'RESERVEDOWNERHOMEWORKTELEPHONE',
  'RESERVEDOWNERMOBILETELEPHONE',
  'RESERVEDOWNEREMAILADDRESS',
  'RESERVEDOWNERIDNUMBER',
  'RESERVEDOWNERLATLONG',
  'RESERVEDOWNERJURISDICTION',
  'RSERVATIONDATE',
  'RESERVATIONSTATUSNAME',
  'ADOPTIONCOORDINATORNAME',
  'ADOPTIONCOORDINATORHOMETELEPHONE',
  'ADOPTIONCOORDINATORWORKTELEPHONE',
  'ADOPTIONCOORDINATORMOBILETELEPHONE',
  'ADOPTIONCOORDINATOREMAILADDRESS',
  'ENTRYREASONNAME',
  'PTSREASONNAME',
  'SHELTERLOCATIONNAME',
  'SHELTERLOCATIONDESCRIPTION',
  'SITEID',
  'SITENAME',
  'PICKUPLOCATIONNAME',
  'JURISDICTIONNAME',
  'ANIMALCONTROLINCIDENTID',
  'ANIMALCONTROLINCIDENTNAME',
  'ANIMALCONTROLINCIDENTDATE',
  'ACTIVEDIETNAME',
  'ACTIVEDIETDESCRIPTION',
  'ACTIVEDIETSTARTDATE',
  'ACTIVEDIETCOMMENTS',
  'ACTIVEMOVEMENTTYPENAME',
  'ACTIVEMOVEMENTADOPTIONNUMBER',
  'ACTIVEMOVEMENTRETURNDATE',
  'ACTIVEMOVEMENTINSURANCENUMBER',
  'ACTIVEMOVEMENTREASONFORRETURN',
  'ACTIVEMOVEMENTTRIALENDDATE',
  'ACTIVEMOVEMENTCOMMENTS',
  'ACTIVEMOVEMENTRESERVATIONDATE',
  'ACTIVEMOVEMENTDONATION',
  'ACTIVEMOVEMENTCREATEDBY',
  'ACTIVEMOVEMENTCREATEDBYNAME',
  'ACTIVEMOVEMENTCREATEDDATE',
  'ACTIVEMOVEMENTLASTCHANGEDBY',
  'ACTIVEMOVEMENTLASTCHANGEDDATE',
  'CODE',
  'DISPLAYLOCATIONNAME',
  'OUTCOMENAME',
  'OUTCOMEDATE',
  'OUTCOMEQUALIFIER',
  'WEBSITEMEDIAID',
  'WEBSITEMEDIANAME',
  'WEBSITEMEDIANOTES',
  'WEBSITEVIDEONOTES',
  'WEBSITEIMAGECOUNT',
  'DOCMEDIAID',
  'DOCMEDIANAME',
  'DOCMEDIADATE',
  'WEBSITEVIDEOURL',
  'WEBSITEVIDEONOTES',
  'HASFUTUREADOPTION',
  'ACTIVERESERVATIONS',
  'RECENTLYCHANGEDIMAGES',
  'HASOUTSTANDINGMEDICAL',
  'HASACTIVEBOARDING',
  'ACTIVEBOARDINGINDATE',
  'ACTIVEBOARDINGOUTDATE',
  'VACCGIVENCOUNT',
  'VACCOUTSTANDINGCOUNT',
  'NONSHELTERANIMALNAME',
  'CRUELTYCASENAME',
  'CROSSBREEDNAME',
  'ESTIMATEDDOBNAME',
  'IDENTICHIPPEDNAME',
  'TATTOONAME',
  'NEUTEREDNAME',
  'COMBITESTEDNAME',
  'COMBITESTRESULTNAME',
  'HEARTWORMTESTEDNAME',
  'HEARTWORMTESTRESULTNAME',
  'FLVRESULTNAME',
  'DECLAWEDNAME',
  'PUTTOSLEEPNAME',
  'ISDOANAME',
  'ISTRANSFERNAME',
  'ISPICKUPNAME',
  'ISGOODWITHCHILDRENNAME',
  'ISGOODWITHCATSNAME',
  'ISGOODWITHDOGSNAME',
  'ISHOUSETRAINEDNAME',
  'ISNOTAVAILABLEFORADOPTIONNAME',
  'ISNOTFORREGISTRATIONNAME',
  'HASSPECIALNEEDSNAME',
  'DIEDOFFSHELTERNAME',
  'HASACTIVERESERVENAME',
  'HASTRIALADOPTIONNAME',
  'DATEAVAILABLEFORADOPTION',
  'NEEDSRESIDENTDOG',
  'PASSPORTNUMBER',
  'LEISHDOG'
]
```
