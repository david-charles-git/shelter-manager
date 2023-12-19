const handleShelterManagerGoToFeedAndFilter: (filterValue: string, filterType: string) => void = (
  filterValue,
  filterType,
) => {
  const parent: HTMLElement = document.getElementsByClassName(
    GLOBAL_shelterManagerFeedParentClassName,
  )[0] as HTMLElement;
  const filters: HTMLCollectionOf<Element> = parent.getElementsByClassName('filter') as HTMLCollectionOf<Element>;
  const feed: HTMLElement = parent.getElementsByClassName('feed')[0] as HTMLElement;
  const limit: string = feed.getAttribute('data-limit') || '100';
  for (let i: number = 0; i < filters.length; i++) {
    filters[i].classList.remove('active');
    if (filters[i].getAttribute('data-value') === filterValue && filters[i].getAttribute('data-type') === filterType) {
      filters[i].classList.add('active');
    }
  }
  handleShelterManagerFilterItems(filterValue, filterType, parseInt(limit));
  scrollToElement(parent);
};
const handleShelterManagerGoToFeedAndFilterByQueryOnLoad: () => void = () => {
  const url: URL = new URL(window.location.href);
  const queryParamsArray: QueryParams = Array.from(url.searchParams.entries());
  var filterValue: string = 'all';
  var filterType: string = 'all';
  var hasQuery: boolean = false;
  for (var a = 0; a < queryParamsArray.length; a++) {
    if (queryParamsArray[a][0] === GLOBAL_shelterManagerFeedFilterValue) {
      filterValue = queryParamsArray[a][1];
      hasQuery = true;
    } else if (queryParamsArray[a][0] === GLOBAL_shelterManagerFeedFilterType) {
      filterType = queryParamsArray[a][1];
      hasQuery = true;
    }
  }
  if (hasQuery) {
    handleShelterManagerGoToFeedAndFilter(filterValue, filterType);
  }
};
const handleShelterManagerFilterFeed: (event: Event) => void = event => {
  preventDefault(event);
  const target: any = event.currentTarget || event.target;
  const parent: HTMLElement = target.closest('body') as HTMLElement;
  const dataType: string = target.getAttribute('data-type') || 'all';
  const dataValue: string = target.getAttribute('data-value') || 'all';
  const feed: HTMLElement = parent.getElementsByClassName('feed')[0] as HTMLElement;
  const filters: HTMLCollectionOf<Element> = parent.getElementsByClassName('filter') as HTMLCollectionOf<Element>;
  const feedLimit: string = feed.getAttribute('data-limit') || '100';
  for (var a: number = 0; a < filters.length; a++) {
    filters[a].classList.remove('active');
  }
  target.classList.add('active');
  handleShelterManagerFilterItems(dataValue, dataType, parseInt(feedLimit));
};
const handleShelterManagerFeedLoadMore: (event: Event) => void = event => {
  preventDefault(event);
  const target: any = event.currentTarget || event.target;
  const parent: HTMLElement = target.closest('body') as HTMLElement;
  const feed: HTMLElement = parent.getElementsByClassName('feed')[0] as HTMLElement;
  const filters: HTMLCollectionOf<Element> = parent.getElementsByClassName('filter') as HTMLCollectionOf<Element>;
  const feedLimit: string = feed.getAttribute('data-limit') || '100';
  const feedCount: string = feed.getAttribute('data-count') || '0';
  var filterValue: string = 'all';
  var filterType: string = 'all';
  for (var a: number = 0; a < filters.length; a++) {
    if (filters[a].classList.contains('active')) {
      filterValue = filters[a].getAttribute('data-value') || '';
      filterType = filters[a].getAttribute('data-type') || '';
      break;
    }
  }
  handleShelterManagerFilterItems(filterValue, filterType, parseInt(feedCount) + parseInt(feedLimit));
};
const handleShelterManagerFeedLoadMore_ajax: (event: Event) => void = event => {
  preventDefault(event);
  const target: any = event.currentTarget || event.target;
  const parent: HTMLElement = target.closest('body') as HTMLElement;
  const feed: HTMLElement = parent.getElementsByClassName('feed')[0] as HTMLElement;
  const filters: HTMLCollectionOf<Element> = parent.getElementsByClassName('filter') as HTMLCollectionOf<Element>;
  const feedLimit: string = feed.getAttribute('data-limit') || '100';
  const feedCount: string = feed.getAttribute('data-count') || '0';
  var filterValue: string = 'all';
  var filterType: string = 'all';
  for (var a: number = 0; a < filters.length; a++) {
    if (filters[a].classList.contains('active')) {
      filterValue = filters[a].getAttribute('data-value') || '';
      filterType = filters[a].getAttribute('data-type') || '';
      break;
    }
  }
  handleShelterManagerFilterItems_ajax('adoptable', parseInt(feedCount) + parseInt(feedLimit), [
    filterValue,
    filterType,
  ]);
};
const handleShelterManagerFilterItems: (value: any, type: string, limit: number) => void = (value, type, limit) => {
  const parent: HTMLElement = document.getElementsByClassName(
    GLOBAL_shelterManagerFeedParentClassName,
  )[0] as HTMLElement;
  const feed: HTMLElement = parent.getElementsByClassName('feed')[0] as HTMLElement;
  const loadMore: HTMLElement = parent.getElementsByClassName('load-more')[0] as HTMLElement;
  const feedItems: HTMLCollectionOf<Element> = feed.getElementsByClassName('item') as HTMLCollectionOf<Element>;
  const parsedValue: number = parseInt(value);
  var activeItemCount: number = 0;
  var totalCount: number = 0;
  for (var a: number = 0; a < feedItems.length; a++) {
    feedItems[a].classList.add('shelter-manager-hidden');
    switch (type) {
      case 'ANIMALAGE':
        const feedItemAge: string = feedItems[a].getAttribute('data-age') || '';
        var group: string = '';
        if (feedItemAge.indexOf('weeks') > -1) {
          group = 'under-1-year';
        } else if (feedItemAge.indexOf('months') > -1 && feedItemAge.indexOf('year') === -1) {
          group = 'under-1-year';
        } else if (feedItemAge.indexOf('year') > -1) {
          const parsedYears: number = parseInt(feedItemAge.split(' ')[0]);
          if (parsedYears >= 1 && parsedYears <= 3) {
            group = '1-3-years';
          } else if (parsedYears > 3) {
            group = 'over-3-years';
          }
        }
        if (value === 'under-1-year' && group === 'under-1-year') {
          totalCount++;
          if (activeItemCount < limit) {
            feedItems[a].classList.remove('shelter-manager-hidden');
            activeItemCount++;
          }
        } else if (value === '1-3-years' && group === '1-3-years') {
          totalCount++;
          if (activeItemCount < limit) {
            activeItemCount++;
            feedItems[a].classList.remove('shelter-manager-hidden');
          }
        } else if (value === 'over-3-years' && group === 'over-3-years') {
          totalCount++;
          if (activeItemCount < limit) {
            activeItemCount++;
            feedItems[a].classList.remove('shelter-manager-hidden');
          }
        }
        break;
      case 'SEX':
        const feedItemSex: string = feedItems[a].getAttribute('data-sex') || '';
        if (feedItemSex === 'Female' && parsedValue === 0) {
          totalCount++;
          if (activeItemCount < limit) {
            activeItemCount++;
            feedItems[a].classList.remove('shelter-manager-hidden');
          }
        } else if (feedItemSex === 'Male' && parsedValue === 1) {
          totalCount++;
          if (activeItemCount < limit) {
            activeItemCount++;
            feedItems[a].classList.remove('shelter-manager-hidden');
          }
        }
        break;
      case 'ISGOODWITHCATSNAME':
        const feedItemLiveWithCats: string = feedItems[a].getAttribute('data-livewithcats') || '';
        if (feedItemLiveWithCats === 'Yes' && value === 'yes') {
          totalCount++;
          if (activeItemCount < limit) {
            activeItemCount++;
            feedItems[a].classList.remove('shelter-manager-hidden');
          }
        }
        break;
      case 'ISGOODWITHDOGSNAME':
        const feedItemLiveWithDogs: string = feedItems[a].getAttribute('data-livewithdogs') || '';
        if (feedItemLiveWithDogs === 'Yes' && value === 'yes') {
          totalCount++;
          if (activeItemCount < limit) {
            activeItemCount++;
            feedItems[a].classList.remove('shelter-manager-hidden');
          }
        }
        break;
      case 'ISGOODWITHCHILDRENNAME':
        const feedItemLiveWithChildren: string = feedItems[a].getAttribute('data-livewithchildren') || '';
        if (feedItemLiveWithChildren !== 'Unknown' && feedItemLiveWithChildren !== 'No' && value === 'yes') {
          totalCount++;
          if (activeItemCount < limit) {
            activeItemCount++;
            feedItems[a].classList.remove('shelter-manager-hidden');
          }
        }
        break;
      case 'NEEDSRESIDENTDOG':
        const feedItemNeedsResidentDog: string = feedItems[a].getAttribute('data-needsresidentdog') || '';
        if (feedItemNeedsResidentDog === 'Yes' && value === 'yes') {
          totalCount++;
          if (activeItemCount < limit) {
            activeItemCount++;
            feedItems[a].classList.remove('shelter-manager-hidden');
          }
        }
        break;
      case 'SHELTERLOCATION':
        const feedItemShelterLocation: string = feedItems[a].getAttribute('data-inuk') || '';
        if (feedItemShelterLocation === 'Yes' && value === 'yes') {
          totalCount++;
          if (activeItemCount < limit) {
            activeItemCount++;
            feedItems[a].classList.remove('shelter-manager-hidden');
          }
        }
        break;
      case 'DATEBROUGHTIN':
        const feedItemDateBroughtIn: string = feedItems[a].getAttribute('data-datebroughtin') || '';
        const feedItemDateBroughtInAsDate: Date = new Date(feedItemDateBroughtIn);
        const feedItemDateBroughtInAsNumber: number = feedItemDateBroughtInAsDate.getTime();
        const date: Date = new Date();
        const dateNowAsNumber: number = date.getTime();
        const differenceInYears: number = (dateNowAsNumber - feedItemDateBroughtInAsNumber) / 1000 / 60 / 60 / 24 / 365;
        if (differenceInYears >= parsedValue) {
          totalCount++;
          if (activeItemCount < limit) {
            activeItemCount++;
            feedItems[a].classList.remove('shelter-manager-hidden');
          }
        }
        break;
      case 'all':
        totalCount++;
        if (activeItemCount < limit) {
          activeItemCount++;
          feedItems[a].classList.remove('shelter-manager-hidden');
        }
        break;
    }
  }
  feed.setAttribute('data-count', activeItemCount.toString());
  if (activeItemCount === totalCount || activeItemCount < limit) {
    loadMore.classList.add('shelter-manager-hidden');
  } else {
    loadMore.classList.remove('shelter-manager-hidden');
  }
};
const handleShelterManagerFilterItems_ajax = (type: string, limit: number, filter: Filter) => {
  const callback: (response: any) => void = response => {
    if (response.error) {
      console.error(`getShelterManagerAnimalsJsonByType error: ${response.message}`);
    }
    console.log(response);
  };
  const callbackError: (response: any) => void = response => {
    console.error(`getShelterManagerAnimalsJsonByType error: ${response.message}`);
  };

  getShelterManagerAnimalsJsonByType(type, limit, filter, callback, callbackError);
};
