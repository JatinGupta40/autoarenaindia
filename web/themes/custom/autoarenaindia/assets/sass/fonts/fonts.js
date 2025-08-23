const tokens = require('../../../../SPACEtokens.json');

const { fontSize } = tokens.fontSize;

const fonts = {
  fontFamily: {
    HelveticaNowDisplay: ['Helvetica-Now-Display', 'Roboto', 'sans-serif'],
    SpaceGrotesk: ['SpaceGrotesk', 'Roboto', 'sans-serif'],
  },
  fontSizes: {
    textXS: fontSize['12'].value,
    textSm: fontSize['14'].value,
    textMd: fontSize['16'].value,
    textLg: fontSize['18'].value,
    textXL: fontSize['20'].value,
    displayXS: fontSize['24'].value,
    displaySm: fontSize['30'].value,
    displayMd: fontSize['36'].value,
    displayLg: fontSize['48'].value,
    displayXL: fontSize['60'].value,
    display2xl: fontSize['72'].value,
    display3XL: fontSize['96'].value,
  },
  fontWeight: {
    regular: '400',
    medium: '500',
    semiBold: '600',
    bold: '700',
  },
};

Object.keys(fontSize).forEach((key) => {
  let [value] = fontSize[key].value;
  value = parseInt(value, 10);
  const remValue = `${value / 16}rem`;
  fontSize[key].value = remValue;
});

export { fonts };
