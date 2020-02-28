const formatFileSize = (size) => {
    const units = ['Byte', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
    const threshold = 1024;
    size = Number(size) * threshold;
    const i = size === 0 ? 0 : Math.floor(Math.log(size) / Math.log(threshold));
    return `${(size / Math.pow(threshold, i)).toFixed(2) * 1} ${units[i]}`;
  };

  const messages = {
    _default: (field) => `Полето е с невалидна стойност.`,
    alpha_dash: (field) => `Полето може да съдържа буквено-цифрови знаци, както и тирета и долни черти.`,
    alpha_num: (field) => `Полето може да съдържа само буквено-цифрови символи.`,
    alpha_spaces: (field) => `Полето може да съдържа само азбучни знаци, както и интервали.`,
    alpha: (field) => `Полето може да съдържа само азбучни знаци.`,
    between: (field, [min, max]) => `Полето  може да е между ${min} и ${max}.`,
    confirmed: (field) => `Потвърждението не съвпада за полето ${field}.`,
    credit_card: (field) => `Полето е навалидно.`,
    decimal: (field, [decimals = '*'] = []) => `Полето трябва да е числено ${!decimals || decimals === '*' ? '' : 'и може да съдържа ${decimals} знака'}`,
    digits: (field, [length]) => `Полето трябва да е цифрово и да съдържа точно ${length} цифри.`,
    dimensions: (field, [width, height]) => `Полето трябва да е ${width} пиксела по ${height} пиксела.`,
    email: (field) => `Полето трябва да е коректен Имейл.`,
    password: (field) => `Полето трябва да е вярната парола.`,
    ext: (field) => `Полето трябва да е валиден файл.`,
    image: (field) => `Полето трябва да е снимка.`,
    included: (field) => `Полето трябва да е валидна стойност.`,
    integer: (field) => `Полето трябва да е цяло число.`,
    ip: (field) => `Полето трябва да е валиден IP адрес.`,
    length: (field, [length, max]) => {
      if (max) {
        return `Полето трябва да е между ${length} и ${max}.`;
      }

      return `Полето трябва да е ${length}.`;
    },
    max: (field, [length]) => `Полето не може да бъде по-голямо от ${length} знака.`,
    max_value: (field, [max]) => `Полето трябва да бъде ${max} или по-малко.`,
    mimes: (field) => `Полето трябва да е валиден тип файл.`,
    min: (field, [length]) => `Полето трябва да съдържа минимум ${length} символа.`,
    min_value: (field, [min]) => `Полето трябва да бъде минимум ${min} или повече.`,
    excluded: (field) => `Полето трябва да е с валидна стойност.`,
    numeric: (field) => `Полето може да съдържа само цифри.`,
    regex: (field) => `Полето съдържа невалиден формат.`,
    required: (field) => `Полето е задължително.`,
    size: (field, [size]) => `Размерът на файла за полето трябва да е под ${formatFileSize(size)}.`,
    url: (field) => `Полето не съдържа валиден URL адрес.`
  };

  const locale = {
    name: 'id',
    messages,
    attributes: {}
  };

  export default locale;
