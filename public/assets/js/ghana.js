//! moment-holiday.js locale configuration
//! locale : Ghana
//! author : appiahmakuta : https://github.com/appiahmakuta

(function() {
  var moment = (typeof require !== 'undefined' && require !== null) && !require.amd ? require('moment') : this.moment;

  moment.holidays.ghana = {
    "New Year's Day": {
      date: '1/1',
      keywords: ['new', 'year']
    },
    "Independence Day": {
      date: '3/6',
      keywords: ['independence']
    },
    "Good Friday": {
      date: 'easter-2',
      keywords_y: ['good', 'friday']
    },
    "Easter Sunday": {
      date: 'easter',
      keywords_y: ['easter'],
      keywords: ['sunday']
    },
    "Easter Monday": {
      date: 'easter+1',
      keywords_y: ['easter', 'monday']
    },
    "May Day": {
      date: '5/1',
      keywords: ['labour']
    },
    "African Unity Day": {
      date: '5/25',
      keywords: ['african?','unity']
    },
    "Eidul-Fitr": {
      date: '6/15',
      keywords: ['eidul', 'fitr']
    },
    "Republic Day": {
      date: '7/1',
      keywords: ['republic']
    },
    "Eidul-Adha": {
      date: '8/21',
      keywords: ['eidul', 'adha']
    },
    "Founders Day": {
      date: '9/21',
      keywords: ['founders']
    },
    "Farmer's Day": {
      date: '12/7',
      keywords: ['farmers']
    },
    "Christmas Day": {
      date: '12/25',
      keywords: ['christ(mas)?']
    },
    "Boxing Day": {
      date: '12/26',
      keywords: ['boxing']
    }
  };

  if ((typeof module !== 'undefined' && module !== null ? module.exports : void 0) != null) { module.exports = moment; }
}).call(this);
