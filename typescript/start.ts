const GLOBAL_shelterManagerAdoptionFormAjaxFunctionName: string = 'ajax_get_animal_adoption_form_submission_response';
const GLOBAL_shelterManagerGetAnimalJsonByIdAjaxFunctionName: string = 'ajax_get_animal_json_by_id';
const GLOBAL_shelterManagerGetAnimalJsonByTypeAjaxFunctionName: string = 'ajax_get_animals_json_by_type';
const GLOBAL_shelterManagerGetAnimalImageByIdAjaxFunctionName: string = 'ajax_get_animal_image_by_id';
const GLOBAL_shelterManagerAdoptionFormId: string = 'shelter-manager-animal-adoption-form';
const GLOBAL_shelterManagerFeedFilterValue: string = 'sm-feed-filter-value';
const GLOBAL_shelterManagerFeedFilterType: string = 'sm-feed-filter-type';
const GLOBAL_shelterManagerFeedParentClassName: string = 'shelter-manager-animal-feed';

window.addEventListener('load', () => {
  handleShelterManagerGoToFeedAndFilterByQueryOnLoad();
});
